<?php

namespace App\Controllers\Managers\Pemasaran;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\CustomerModel;
use App\Models\M_Role;
use App\Models\M_UserClosing;
use App\Models\M_Files;
use App\Models\M_UserReport;
use App\Models\M_CancellationReport;
use App\Models\M_UserEnergize;

class DetailCustomer extends BaseController
{
    protected $M_Auth, $M_Role,  $M_UserReport, $M_CancellationReport, $M_UserClosing, $M_UserEnergize, $M_Files, $CustomerModel;


    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_UserReport = new M_UserReport();
        $this->M_CancellationReport = new M_CancellationReport();
        $this->M_UserEnergize = new M_UserEnergize();
        $this->M_UserClosing = new M_UserClosing();
        $this->M_Files = new M_Files();
        $db = db_connect();
        $this->CustomerModel = new CustomerModel($db);
    }

    public function index($id_customer)
    {
        $session = session();
        $data['title'] = 'Customer Profile';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] = $this->M_Role->find($session->get('id_role'));

        $role = 'Account Executive';

        // Data Customer
        $data['customer'] = $this->CustomerModel->getAllInformationCustomerById($id_customer);


        // Data File sesuai dengan customer
        $closing = $this->M_UserClosing
            ->where('id_customer', $id_customer)
            ->orderBy('created_at', 'desc')
            ->first();

        // d($closing);
        if ($closing) {
            $id_dir_file_closing = [
                'id_app_letter' => $closing['id_app_letter'],
                'id_record_of_agreement' => $closing['id_record_of_agreement'],
                'id_reksis_sld' => $closing['id_reksis_sld'],
                'id_spjbtl' => $closing['id_spjbtl'],
                'id_record_of_agreement' => $closing['id_working_order']
            ];

            $data['file_closing'] = $this->M_Files->getFileFromMultipleDirectories($id_dir_file_closing);
            // d($data['file_closing']);
        }


        // Data Pengawas
        $data['ae'] = $this->M_Auth->find($data['customer']['id_salesman']);

        // Data Report Log
        $data['report_log'] = $this->M_UserReport->getReportByRolePerCustomer($role, $id_customer);

        // Data Cancellation Report
        $data['cancellation_report'] = $this->M_CancellationReport->getCancellationReportByRole($role);
        // d($data['cancellation_report']);

        // Data Energize Report
        $id_dir_file_energize = $this->M_UserEnergize->getFileEnergize($id_customer);
        if ($id_dir_file_energize) {
            $data['file_energize'] =
                $this->M_Files->getFileEnergize($id_dir_file_energize['id_ba_aco'], $id_dir_file_energize['id_work_order']);
        }

        // Jika sudah ditentukan pengawasnya
        if (!is_null($data['customer']['id_pengawas'])) {
            $data['pengawas'] = $this->M_Auth->find($data['customer']['id_pengawas']);
            // Data Report Log
            $data['construction_log'] = $this->M_UserReport->getReportByRolePerCustomer('Construction', $id_customer);
        }

        $data['user_construction'] = $this->M_Auth->where('id_role', 5)->find();
        // d($data['customer']);
        return view('managers/pemasaran/detail_customer', $data);
    }
}
