<?php

namespace App\Controllers\AccountExecutive;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\CustomerModel;
use App\Models\M_Role;

class RejuvenationData extends BaseController
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
        $data['title'] = 'Rejuvenate Data';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        // Data Potential Customer Sesuai dengan Salesnya
        $data['customer'] = $this->CustomerModel->getCustomerById($id_customer);
        $data['service'] = $this->CustomerModel->getService();
        $data['substation'] = $this->CustomerModel->getSubstation();
        $data['feeder_substation'] = $this->CustomerModel->getFeederSubstation();
        $data['tariff'] = $this->CustomerModel->getTariff();

        return view('account_executive/rejuvenate_data', $data);
    }

    public function add($id_customer)
    {
        $session = session();

        if ($this->request->getMethod() == "put") {
            $rules = [
                // Profile
                'cust-name' => [
                    'label' => 'Customer Name',
                    'rules' => 'required'
                ],
                'cust-address' => [
                    'label' => 'Customer Address',
                    'rules' => 'required|min_length[10]'
                ],
                'tariff' => [
                    'label' => 'Tarif',
                    'rules' => 'required|max_length[2]',
                    'errors' => [
                        'max_length' => '3 Characters Only'
                    ]
                ],
                'power' => [
                    'label' => 'Daya',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'numeric' => 'Numbers Only'
                    ]
                ],
                'recommend-service' => [
                    'label' => 'Service',
                    'rules' => 'required'
                ],

                // Company Profile

                'company-name' => [
                    'label' => 'Company\'s Name',
                    'rules' => 'required|',
                    'errors' => [
                        'required' => '{field} field is required.'
                    ]
                ],
                'address-company' => [
                    'label' => 'Company\'s Name',
                    'rules' => 'required|',
                    'errors' => [
                        'required' => '{field} field is required.'
                    ]
                ],
                'phone-company' => [
                    'label' => 'Company\'s Name',
                    'rules' => 'required|',
                    'errors' => [
                        'required' => '{field} field is required.'
                    ]
                ],
                'company-name' => [
                    'label' => 'Company\'s Name',
                    'rules' => 'required|',
                    'errors' => [
                        'required' => '{field} field is required.'
                    ]
                ],
                'company-name' => [
                    'label' => 'Company\'s Name',
                    'rules' => 'required|',
                    'errors' => [
                        'required' => '{field} field is required.'
                    ]
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
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            }
        }
    }
}
