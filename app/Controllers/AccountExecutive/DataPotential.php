<?php

namespace App\Controllers\AccountExecutive;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\CustomerModel;
use App\Models\M_Role;

class DataPotential extends BaseController
{
    protected $M_Auth, $M_Role, $CustomerModel;


    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $db = db_connect();
        $this->CustomerModel = new CustomerModel($db);
    }

    public function index()
    {
        $session = session();
        $data['title'] = 'Data Potential Customer';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        // Data Potential Customer Sesuai dengan Salesnya
        $data['customer'] =
            ($data['role']['id_role'] == 1) ? $this->CustomerModel->getCustomer() : $this->CustomerModel->getCustomerBySales($session->get('id_user'));


        return view('account_executive/index', $data);
    }
}
