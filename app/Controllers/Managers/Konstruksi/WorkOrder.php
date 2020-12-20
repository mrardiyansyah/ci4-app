<?php

namespace App\Controllers\Managers\Konstruksi;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\M_Customer;
use App\Models\CustomerModel;
use App\Models\M_Role;
use App\Models\M_UserClosing;
use App\Models\M_Files;
use App\Models\M_UserReport;
use App\Models\M_CancellationReport;
use App\Models\M_UserEnergize;

class WorkOrder extends BaseController
{
    protected $M_Auth, $M_Role, $M_Customer, $M_UserClosing, $M_Files, $M_UserEnergize, $M_UserReport, $M_CancellationReport, $CustomerModel;


    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_Customer = new M_Customer();
        $this->M_UserClosing = new M_UserClosing();
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

        $data['information'] = $this->CustomerModel->getInformationForWorkingOrder();

        return view('managers/konstruksi/work_order', $data);
    }

    public function detail($id_customer)
    {
        $session = session();
        $data['title'] = 'Customer Profile';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));

        // Data Customer
        $data['customer'] = $this->CustomerModel->getAllInformationCustomerById($id_customer);

        // Data File sesuai dengan customer
        $id_dir_file = $this->M_UserClosing->getDirFileForConstruction($id_customer);
        $data['file_construction'] =
            $this->M_Files->getInfoFileForConstruction($id_dir_file['id_reksis_sld'], $id_dir_file['id_working_order']);
        // d($data['file_construction']);

        // Data Pengawas
        $data['pengawas'] = $this->M_Auth->find($data['customer']['id_pengawas']);

        // Data Report Log
        $role = 'Construction';

        // Data Cancellation Report
        $data['cancellation_report'] = $this->M_CancellationReport->getCancellationReportByRole($role);

        // Data Energize Report
        $id_dir_file_energize = $this->M_UserEnergize->getFileEnergize($id_customer);
        if ($id_dir_file_energize) {
            $data['file_energize'] =
                $this->M_Files->getFileEnergize($id_dir_file_energize['id_ba_aco'], $id_dir_file_energize['id_work_order'], $id_dir_file_energize['id_documentation']);
            // d($data['file_energize']);
        }

        // Jika sudah ditentukan pengawasnya
        if (!is_null($data['customer']['id_pengawas'])) {
            $data['pengawas'] = $this->M_Auth->find($data['customer']['id_pengawas']);
            // Data Report Log
            $data['report_log'] = $this->M_UserReport->getReportByRolePerCustomer($role, $id_customer);
        }

        $data['user_construction'] = $this->M_Auth->where('id_role', 5)->find();
        // d($data['customer']);
        return view('managers/konstruksi/detail_customer', $data);
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
                $customer = $this->CustomerModel->getCustomerById($id_customer);
                $cust_name = $customer['name_customer'];
                $id_salesman = $customer['id_salesman'];
                // dd($id_pengawas);
                try {
                    $this->M_Customer->update($id_customer, ['id_pengawas' => $id_pengawas]);
                } catch (\Exception $e) {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">There something went wrong! ' . $this->M_Customer->errors() . '</div>');
                    return redirect()->back();
                }

                $this->M_Notification->setNotification(
                    $id_customer,
                    $session->get('id_user'),
                    $id_pengawas,
                    'Request',
                    "Congratulations, you have been selected as the construction supervisor for customer {$cust_name}. Please check the following attachments and start construction!",
                    'Request'
                );
                $this->M_Notification->setNotification(
                    $id_customer,
                    $session->get('id_user'),
                    $id_salesman,
                    'Info',
                    "The construction supervisor for customer {$cust_name} has been selected. Check it out!",
                    'Info'
                );
                $message = [
                    'message' => 'success'
                ];
                $this->pusher->trigger('my-channel', 'my-event', $message);
                $session->setFlashdata('message', '<div class="alert alert-success" role="alert">
                   The Construction Supervisor has been Selected!</div>');
                return redirect()->back();
            }
        } else {
            $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Failed to select The Supervisor!' . '</div>');
            return redirect()->back();
        }
    }
}
