<?php

namespace App\Controllers\Construction;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\M_Customer;
use App\Models\CustomerModel;
use App\Models\M_Role;
use App\Models\M_UserClosing;
use App\Models\M_Directories;
use App\Models\M_Files;
use App\Models\M_UserReport;
use App\Models\M_UserEnergize;
use App\Models\M_CancellationReport;

class WorkOrder extends BaseController
{
    protected $M_Auth, $M_Role, $M_Customer, $M_UserClosing, $M_Directories, $M_Files, $M_UserEnergize, $M_UserReport, $M_CancellationReport, $CustomerModel;


    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_Customer = new M_Customer();
        $this->M_UserClosing = new M_UserClosing();
        $this->M_Directories = new M_Directories();
        $this->M_Files = new M_Files();
        $this->M_UserReport = new M_UserReport();
        $this->M_UserEnergize = new M_UserEnergize();
        $this->M_CancellationReport = new M_CancellationReport();
        $db = db_connect();
        $this->CustomerModel = new CustomerModel($db);
    }

    public function index()
    {
        $session = session();
        $data['title'] = 'Work Order Request';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['information'] = $this->CustomerModel->getWorkOrderForConstruction($session->get('id_user'));

        return view('construction/index', $data);
    }

    public function detailCustomer($id_customer)
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $data['title'] = 'Detail Information';
            $data['user'] = $this->M_Auth->find($session->get('id_user'));
            $data['role'] =  $this->M_Role->find($session->get('id_role'));
            $data['notif'] = get_new_notif();

            // Data Customer
            $data['customer'] = $this->CustomerModel->getAllInformationCustomerById($id_customer);

            // Data File sesuai dengan customer
            $id_dir_file = $this->M_UserClosing->getDirFileForConstruction($id_customer);
            $data['file_construction'] =
                $this->M_Files->getInfoFileForConstruction($id_dir_file['id_reksis_sld'], $id_dir_file['id_working_order']);

            // Data Pengawas
            $data['pengawas'] = $this->M_Auth->find($data['customer']['id_pengawas']);

            // Data Report Log
            $data['report_log'] = $this->M_UserReport->getReportLog($session->get('id_user'), $id_customer);

            // Data Cancellation Report
            $data['cancellation_report'] = $this->M_CancellationReport->getCancellationReport($session->get('id_user'), $id_customer);

            // Data Energize Report
            $id_dir_file_energize = $this->M_UserEnergize->getFileEnergize($id_customer);
            if ($id_dir_file_energize) {
                $data['file_energize'] =
                    $this->M_Files->getFileEnergize($id_dir_file_energize['id_ba_aco'], $id_dir_file_energize['id_work_order'], $id_dir_file_energize['id_documentation']);
            }

            // d($data['file_energize']);
            // d($data['file_construction']);

            return view('construction/detailCustomer', $data);
        } else {
            return redirect()->route('blocked');
        }
    }

    public function pilihPengawas($id_customer)
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'pengawas' => [
                    'label' => 'Pengawas Konstruksi',
                    'rules' => 'required',
                ],
            ];

            if (!$this->validate($rules)) {
                session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">' . $this->validator->listErrors() . '</div>');
                return redirect()->back();
            } else {
                $id_pengawas = $this->request->getPost('pengawas');
                // dd($id_pengawas);
                try {
                    $this->M_Customer->update($id_customer, ['id_pengawas' => $id_pengawas]);
                } catch (\Exception $e) {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">There something went wrong! ' . $this->M_Customer->errors() . '</div>');
                    return redirect()->back();
                }

                $session->setFlashdata('message', '<div class="alert alert-success" role="alert">
                   The Construction Supervisor has been Selected!</div>');
                return redirect()->back();
            }
        } else {
            $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Failed to select The Supervisor!' . '</div>');
            return redirect()->back();
        }
    }

    public function startConstruct($id_customer)
    {
        $session = session();
        if ($this->request->isAJAX()) {
            try {
                $update_information = $this->M_Customer->update($id_customer, ['id_information' => 8]);

                if ($update_information) {
                    echo json_encode(['success' => 'success']);
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
}
