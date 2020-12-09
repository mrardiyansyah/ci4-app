<?php

namespace App\Controllers\Managers\Pemasaran;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\M_Customer;
use App\Models\CustomerModel;
use App\Models\M_Role;
use App\Models\M_UserClosing;
use App\Models\M_Directories;
use App\Models\M_Files;
use App\Models\M_UserReport;
use App\Models\M_CancellationReport;
use App\Models\M_UserEnergize;

class DetailCustomer extends BaseController
{
    protected $M_Auth, $M_Role, $M_Customer, $M_UserReport, $M_CancellationReport, $M_UserClosing, $M_UserEnergize, $M_Directories, $M_Files, $CustomerModel;


    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_UserReport = new M_UserReport();
        $this->M_CancellationReport = new M_CancellationReport();
        $this->M_UserEnergize = new M_UserEnergize();
        $this->M_Customer = new M_Customer();
        $this->M_UserClosing = new M_UserClosing();
        $this->M_Directories = new M_Directories();
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
        $data['notif'] = get_new_notif();

        $role = 'Account Executive';

        // Data Customer
        $data['customer'] = $this->CustomerModel->getAllInformationCustomerById($id_customer);


        // Data File sesuai dengan customer
        $id_dir_file_construction = $this->M_UserClosing->getDirFileForConstruction($id_customer);
        if ($id_dir_file_construction) {
            $data['file_construction'] =
                $this->M_Files->getInfoFileForConstruction($id_dir_file_construction['id_reksis_sld'], $id_dir_file_construction['id_working_order']);
        }

        // Data Pengawas
        $data['ae'] = $this->M_Auth->find($data['customer']['id_salesman']);

        // Data Report Log
        $data['report_log'] = $this->M_UserReport->getReportByRolePerCustomer($role, $id_customer);
        // Data Cancellation Report
        $data['cancellation_report'] = $this->M_CancellationReport->getCancellationReport($session->get('id_user'), $id_customer);

        // Data Energize Report
        $id_dir_file_energize = $this->M_UserEnergize->getFileEnergize($id_customer);
        if ($id_dir_file_energize) {
            $data['file_energize'] =
                $this->M_Files->getFileEnergize($id_dir_file_energize['id_ba_aco'], $id_dir_file_energize['id_work_order'], $id_dir_file_energize['id_documentation']);
        }

        // Jika sudah ditentukan pengawasnya
        if (!is_null($data['customer']['id_pengawas'])) {
            $data['pengawas'] = $this->M_Auth->find($data['customer']['id_pengawas']);
            // Data Report Log
            $data['report_log'] = $this->M_UserReport->getReportLog($session->get('id_user'), $id_customer);
        }

        $data['user_construction'] = $this->M_Auth->where('id_role', 5)->find();
        // d($data['customer']);
        return view('managers/pemasaran/detail_customer', $data);
    }
}
