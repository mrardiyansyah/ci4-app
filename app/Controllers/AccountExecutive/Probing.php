<?php

namespace App\Controllers\AccountExecutive;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\CustomerModel;
use App\Models\M_Role;

class Probing extends BaseController
{
    protected $M_Auth, $M_Role, $CustomerModel;


    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $db = db_connect();
        $this->CustomerModel = new CustomerModel($db);
    }

    public function index($id_customer)
    {
        $session = session();
        $data['title'] = 'Sales Log Form';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['customer'] = $this->CustomerModel->getCustomerById($id_customer);
        $data['validation'] = \Config\Services::validation();

        return view('account_executive/sales_log_form', $data);
    }

    public function save($id_customer)
    {
        $rules = [
            'date_report' => [
                'label' => 'Date',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} field is required'
                ]
            ],
            'start_time' => [
                'label' => 'Start Time',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} field is required'
                ]
            ],
            'end_time' => [
                'label' => 'End Time',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} field is required'
                ]
            ],
            'discussed' => [
                'label' => 'Discussed',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} field is required'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }
    }
}
