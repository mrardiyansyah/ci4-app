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

class DataCustomer extends BaseController
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
        $data['title'] = 'Data Potential Customer';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        // $data['notif'] = get_new_notif();
        $role = 'Account Executive';

        // Data Customer
        $data['customer'] = $this->CustomerModel->getAllCustomer();

        return view('managers/pemasaran/dataCustomer', $data);
    }
}
