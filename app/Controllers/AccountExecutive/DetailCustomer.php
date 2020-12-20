<?php

namespace App\Controllers\AccountExecutive;

use App\Controllers\BaseController;
use App\Models\M_Auth;
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
    protected $M_Auth, $M_Role, $M_UserReport, $M_CancellationReport, $M_UserClosing, $M_UserEnergize, $M_Directories, $M_Files, $CustomerModel;


    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_UserReport = new M_UserReport();
        $this->M_CancellationReport = new M_CancellationReport();
        $this->M_UserEnergize = new M_UserEnergize();
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

        $role = 'Account Executive';

        // Data Customer
        $data['customer'] = $this->CustomerModel->getAllInformationCustomerById($id_customer);


        // Data File sesuai dengan customer
        $closing = $this->M_UserClosing
            ->where('id_customer', $id_customer)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($closing) {
            $id_dir_file_closing = [
                'id_app_letter' => $closing['id_app_letter'],
                'id_record_of_agreement' => $closing['id_record_of_agreement'],
                'id_reksis_sld' => $closing['id_reksis_sld'],
                'id_spjbtl' => $closing['id_spjbtl'],
                'id_record_of_agreement' => $closing['id_working_order']
            ];

            $data['file_closing'] = $this->M_Files->getFileFromMultipleDirectories($id_dir_file_closing);
        }


        // Data Pengawas
        $data['ae'] = $this->M_Auth->find($data['customer']['id_salesman']);

        // Data Report Log
        $data['report_log'] = $this->M_UserReport->getReportByRolePerCustomer($role, $id_customer);

        // Data Report Log (Construction)
        if (!is_null($data['customer']['id_pengawas'])) {
            // Jika sudah ditentukan pengawasnya
            $data['pengawas'] = $this->M_Auth->find($data['customer']['id_pengawas']);
            $data['construction_log'] = $this->M_UserReport->getReportByRolePerCustomer('Construction', $id_customer);
        }

        // Data Cancellation Report
        $data['cancellation_report'] = $this->M_CancellationReport->getCancellationReport($session->get('id_user'), $id_customer);

        // Data Energize Report
        $id_dir_file_energize = $this->M_UserEnergize->getFileEnergize($id_customer);
        if ($id_dir_file_energize) {
            $data['file_energize'] =
                $this->M_Files->getFileEnergize($id_dir_file_energize['id_ba_aco'], $id_dir_file_energize['id_work_order'], $id_dir_file_energize['id_documentation']);
        }



        $data['user_construction'] = $this->M_Auth->where('id_role', 5)->find();
        // d($data['customer']);
        return view('account_executive/detail_customer', $data);
    }

    public function dataReport($id_report)
    {
        $session = session();
        if ($this->request->isAJAX()) {
            try {
                $report = $this->M_UserReport->getReportLogById($id_report);

                $dir = $this->M_Directories->find($report['id_directories']);

                $images = $this->M_Files->getAllInfoFileFromDirectories($dir['id_dir']);

                if (!empty($report) && !empty($images)) {
                    echo json_encode([
                        'success' => 'success',
                        'data' => $report,
                        'images' => $images
                    ]);
                } else {
                    throw new \Exception("Error Processing Request", 1);
                }
            } catch (\Exception $e) {
                echo json_encode([
                    'error' => [
                        'message' => $e->getMessage(),
                        'code' => $e->getCode(),
                    ],
                ]);
            }
        }
    }

    public function dataProblemReport($id_report)
    {
        $session = session();
        if ($this->request->isAJAX()) {
            try {
                $report = $this->M_CancellationReport->getReportLogById($id_report);

                $dir = $this->M_Directories->find($report['id_directories']);

                $images = $this->M_Files->getAllInfoFileFromDirectories($dir['id_dir']);

                if (!empty($report) && !empty($images)) {
                    echo json_encode([
                        'success' => 'success',
                        'data' => $report,
                        'images' => $images
                    ]);
                } else {
                    throw new \Exception("Error Processing Request", 1);
                }
            } catch (\Exception $e) {
                echo json_encode([
                    'error' => [
                        'message' => $e->getMessage(),
                        'code' => $e->getCode(),
                    ],
                ]);
            }
        }
    }
}
