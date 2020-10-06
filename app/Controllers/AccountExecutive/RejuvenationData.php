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
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required.'
                    ]
                ],
                'address-company' => [
                    'label' => 'Company\'s Address',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required.'
                    ]
                ],
                'phone-company' => [
                    'label' => 'Company\'s Phone Number',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required.'
                    ]
                ],
                'facsimile' => [
                    'label' => 'Facsimile',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required.'
                    ]
                ],
                'email-company' => [
                    'label' => 'Company\'s Email',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required.'
                    ]
                ],
                'establishment' => [
                    'label' => 'Company Establishment Date',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required.'
                    ]
                ],

                // Chief Information
                'company-leader-name' => [
                    'label' => 'Leader\'s Name',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'leader-position-company' => [
                    'label' => 'Leader\'s Position',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'phone-leader-company' => [
                    'label' => 'Leader\'s Phone Number',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'email-leader-company' => [
                    'label' => 'Leader\'s Email',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],

                // Finance Information
                'company-finance-name' => [
                    'label' => 'Finance\'s Name',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'finance-position-company' => [
                    'label' => 'Finance\'s Position',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'phone-finance-company' => [
                    'label' => 'Finance\'s Phone Number',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'email-finance-company' => [
                    'label' => 'Finance\'s Email',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],

                // Engineering Affairs Information
                'company-engineering-name' => [
                    'label' => 'Engineer\'s Name',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'engineering-position-company' => [
                    'label' => 'Engineer\'s Position',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'phone-engineering-company' => [
                    'label' => 'Engineer\'s Phone Number',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'email-engineering-company' => [
                    'label' => 'Engineer\'s Email',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],

                // General Affairs Information
                'company-general-name' => [
                    'label' => 'General Affairs Name',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'general-position-company' => [
                    'label' => 'General Affairs Position',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'phone-general-company' => [
                    'label' => 'General Affairs Phone Number',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'email-general-company' => [
                    'label' => 'General Affairs Email',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],

                // Technical Specification
                'captive-power' => [
                    'label' => 'Captive Power',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'amount-of-power' => [
                    'label' => 'Amount of Power',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'next-meeting' => [
                    'label' => 'Next Meeting',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'suggestion' => [
                    'label' => 'Suggestion',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                d($this->request->getPost());
            }
        }
        return view('account_executive/rejuvenate_data', $data);
    }

    public function add($id_customer)
    {
        $session = session();
    }
}
