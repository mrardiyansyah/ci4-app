<?php

namespace App\Controllers\Planning;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\CustomerModel;
use App\Models\CustomModel;
use App\Models\M_Customer;
use App\Models\M_Role;

class AddPotential extends BaseController
{
    protected $M_Auth, $M_Role, $M_Customer, $CustomerModel, $CustomModel;


    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_Customer = new M_Customer();
        $db = db_connect();
        $this->CustomerModel = new CustomerModel($db);
        $this->CustomModel = new CustomModel($db);
    }

    public function index()
    {
        $session = session();
        $data['title'] = 'Input Customer Potential';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['customer'] = $this->CustomerModel->getCustomer();
        $data['service'] = $this->CustomerModel->getService();
        $data['substation'] = $this->CustomerModel->getSubstation();
        $data['feeder_substation'] = $this->CustomerModel->getFeederSubstation();
        $data['tariff'] = $this->CustomerModel->getTariff();

        if ($this->request->getMethod() == "PUT") {
            $session = session();
            $rules = [
                '' => [
                    'label' => '',
                    'rules' => 'required|',
                    'errors' => [
                        '' => ''
                    ]
                ],
            ];
            $rules = [
                'cust-name' => [
                    'label' => 'Customer Name',
                    'rules' => 'Required'
                ],
                'cust-id' => [
                    'label' => 'ID Customer',
                    'rules' => 'required|max_length[9]',
                    'errors' => [
                        'max_length' => 'ID Customer maximum length is 9'
                    ]
                ],
                'power' => [
                    'label' => 'Daya',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'numeric' => 'Numbers Only'
                    ]
                ],
                'tariff' => [
                    'label' => 'Tarif',
                    'rules' => 'required|max_length[2]',
                    'errors' => [
                        'max_length' => '3 Characters Only'
                    ]
                ],
                'cust-address' => [
                    'label' => 'Customer Address',
                    'rules' => 'required|min_length[10]'
                ],
                'substation' => [
                    'label' => 'Substation',
                    'rules' => 'required'
                ],
                'feeder-substation' => [
                    'label' => 'Feeder Substation',
                    'rules' => 'required'
                ],
                'subsistem' => [
                    'label' => 'Subsistem',
                    'rules' => 'required'
                ],
                'bep-value' => [
                    'label' => 'BEP Value',
                    'rules' => 'required'
                ],
                'recommend-service' => [
                    'label' => 'Service',
                    'rules' => 'required'
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validator'] = $this->validator;
            } else {
                $data = [
                    'name_customer' => $this->request->getPost('cust-name'),
                    'id_customer' => $this->request->getPost('cust-id'),
                    'id_tariff' => $this->request->getPost('tariff'),
                    'power' => $this->request->getPost('power'),
                    'address_customer' => $this->request->getPost('cust-address'),
                    'id_substation' => $this->request->getPost('substation'),
                    'id_feeder_substation' => $this->request->getPost('feeder-substation'),
                    'subsistem' => $this->request->getPost('subsistem'),
                    'bep_value' => $this->request->getPost('bep-value'),
                    'id_type_of_service' => $this->request->getPost('recommend-service'),
                    'id_status' => '1',
                    'id_information' => 1
                ];

                $this->M_Customer->insert($data);
            }
        }

        return view('planning/input_potential', $data);
    }

    public function add()
    {
    }
}
