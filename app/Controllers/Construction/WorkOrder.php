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
        // $data['notif'] = get_new_notif();

        $data['information'] = $this->CustomerModel->getWorkOrderForConstruction($session->get('id_user'));

        return view('construction/index', $data);
    }

    public function detailCustomer($id_customer)
    {
        $session = session();
        $data['title'] = 'Detail Information';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        // $data['notif'] = get_new_notif();

        // Data Customer
        $data['customer'] = $this->CustomerModel->getAllInformationCustomerById($id_customer);

        // Data File sesuai dengan customer
        $id_dir_file = $this->M_UserClosing->getDirFileForConstruction($id_customer);
        $data['file_construction'] =
            $this->M_Files->getInfoFileForConstruction($id_dir_file['id_reksis_sld'], $id_dir_file['id_working_order']);

        // Data Pengawas
        $data['pengawas'] = $this->M_Auth->find($data['customer']['id_pengawas']);

        // Data Report Log
        $role = 'Construction';
        $data['report_log'] = $this->M_UserReport->getReportByRolePerCustomer($role, $id_customer);

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
    }

    public function startConstruct($id_customer)
    {
        $session = session();
        if ($this->request->isAJAX()) {
            try {
                $update_information = $this->M_Customer->update($id_customer, ['id_information' => 8]);
                $customer = $this->CustomerModel->getCustomerById($id_customer);
                $cust_name = $customer['name_customer'];
                $id_salesman = $customer['id_salesman'];
                if ($update_information) {
                    $this->M_Notification->setNotification(
                        $id_customer,
                        $session->get('id_user'),
                        $id_salesman,
                        'Info',
                        "Construction for {$cust_name} has started. Please check the construction reports periodically!",
                        'Info'
                    );
                    $this->M_Notification->setNotification(
                        $id_customer,
                        $session->get('id_user'),
                        5,
                        'Info',
                        "Construction for {$cust_name} has started. Please check the construction reports periodically!",
                        'Info'
                    );
                    $this->M_Notification->setNotification(
                        $id_customer,
                        $session->get('id_user'),
                        6,
                        'Info',
                        "Construction for {$cust_name} has started. Please check the construction reports periodically!",
                        'Info'
                    );
                    $message = [
                        'message' => 'success'
                    ];
                    $this->pusher->trigger('my-channel', 'my-event', $message);
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
