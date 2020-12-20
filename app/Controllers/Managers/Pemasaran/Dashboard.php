<?php

namespace App\Controllers\Managers\Pemasaran;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\M_Customer;
use App\Models\CustomerModel;
use App\Models\M_Role;
use App\Models\M_UserReport;
use App\Models\M_CancellationReport;
use App\Models\M_Notification;

class Dashboard extends BaseController
{
    protected $M_Auth, $M_Role, $M_Customer, $M_UserReport, $M_CancellationReport, $CustomerModel, $M_Notification;


    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_UserReport = new M_UserReport();
        $this->M_CancellationReport = new M_CancellationReport();
        $this->M_Customer = new M_Customer();
        $this->M_Notification = new M_Notification();
        $db = db_connect();
        $this->CustomerModel = new CustomerModel($db);
    }

    public function index()
    {
        $session = session();
        $data['title'] = 'Dashboard Pemasaran';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        // $data['notif'] = get_new_notif();
        $role = 'Account Executive';

        // $notif = $this->M_Notification->setNotification(
        //     1,
        //     $session->get('id_user'),
        //     1,
        //     'test',
        //     'test',
        //     'Info'
        // );
        // d($notif);
        // $data['asu'] = 'asu';
        // $this->pusher->trigger('my-channel', 'my-event', $data['asu']);

        // Total Customer
        $data['total_customer'] = $this->M_Customer->countAllResults();

        // Total Customer Problem Mapping
        $data['total_problem_mapping'] = $this->M_Customer->where(['id_status' => 2])->countAllResults();

        // Total Customer Closing
        $data['total_closing'] = $this->M_Customer->where(['id_status' => 3])->countAllResults();

        // Total Customer On Construction
        $data['total_construction'] = $this->M_Customer->where(['id_status' => 4])->countAllResults();

        // Total Customer Energizing / Finished
        $data['total_energize'] = $this->M_Customer->where(['id_status' => 5])->orWhere(['id_status' => 6])->countAllResults();

        // Total Customer Terminated
        $data['total_terminated'] = $this->M_Customer->where(['id_status' => 7])->countAllResults();

        // Data Customer
        $data['information'] = $this->CustomerModel->getAllCustomer();

        // Data Work Order (Construction)
        $data['work_order'] = $this->CustomerModel->getInformationForWorkingOrder();

        // All Report Log
        $data['report_log'] = $this->M_UserReport->getReportByRole($role);

        // All Problem Report
        $data['problem_report'] = $this->M_CancellationReport->getCancellationReportByRole($role);

        // List Supervisor Construction
        $data['list_ae'] = $this->M_Auth->getAllAccountExecutive();

        return view('managers/pemasaran/dashboard', $data);
    }
}
