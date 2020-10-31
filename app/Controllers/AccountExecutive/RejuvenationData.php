<?php

namespace App\Controllers\AccountExecutive;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\CustomerModel;
use App\Models\M_Customer;
use App\Models\M_CompanyProfile;
use App\Models\M_CompanyLeader;
use App\Models\M_CompanyFinance;
use App\Models\M_CompanyGeneral;
use App\Models\M_CompanyEngineering;
use App\Models\M_Role;

class RejuvenationData extends BaseController
{
    protected $M_Auth, $M_Role, $CustomerModel, $M_Customer, $M_CompanyProfile, $M_CompanyLeader, $M_CompanyFinance, $M_CompanyGeneral, $M_CompanyEngineering;


    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_Customer = new M_Customer();
        $this->M_CompanyProfile = new M_CompanyProfile();
        $this->M_CompanyLeader = new M_CompanyLeader();
        $this->M_CompanyFinance = new M_CompanyFinance();
        $this->M_CompanyEngineering = new M_CompanyEngineering();
        $this->M_CompanyGeneral = new M_CompanyGeneral();
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
        $data['validation'] = \Config\Services::validation();


        return view('account_executive/rejuvenate_data', $data);
    }

    public function asu($id_customer)
    {
        dd($_SESSION);
    }

    public function add($id_customer)
    {
        $session = session();
        if ($this->request->getMethod() == "put") {

            // Rules for Validation
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
                    'rules' => 'required|min_length[10]',
                    'errors' => [
                        'required' => '{field} field is required.'
                    ]
                ],
                'phone-company.full' => [
                    'label' => 'Company\'s Phone Number',
                    'rules' => 'required|validatePhoneNumber',
                    'errors' => [
                        'required' => '{field} field is required.',
                        'validatePhoneNumber' => 'Invalid Phone Number'
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
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} field is required.',
                        'valid_email' => 'Please enter a valid email address'
                    ]
                ],
                'establishment' => [
                    'label' => 'Establishment Date',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required.'
                    ]
                ],

                // Chief Information
                'company-leader-name' => [
                    'label' => 'Leader\'s Name',
                    'rules' => 'required|alpha_space',
                    'errors' => [
                        // 'required' => '{field} field is required'
                        'alpha_space' => 'Please enter alphabets only'
                    ]
                ],
                'leader-position-company' => [
                    'label' => 'Leader\'s Position',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'phone-leader-company.full' => [
                    'label' => 'Leader\'s Phone Number',
                    'rules' => 'required|validatePhoneNumber',
                    'errors' => [
                        'required' => '{field} field is required',
                        'validatePhoneNumber' => 'Invalid Phone Number'
                    ]
                ],
                'email-leader-company' => [
                    'label' => 'Leader\'s Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} field is required',
                        'valid_email' => 'Please enter a valid email address'
                    ]
                ],

                // Finance Information
                'company-finance-name' => [
                    'label' => 'Finance\'s Name',
                    'rules' => 'permit_empty|alpha_space',
                    'errors' => [
                        // 'required' => '{field} field is required'
                        'alpha_space' => 'Please enter alphabets only'
                    ]
                ],
                'finance-position-company' => [
                    'label' => 'Finance\'s Position',
                    'rules' => 'permit_empty',
                    'errors' => [
                        // 'required' => '{field} field is required'
                    ]
                ],
                'phone-finance-company.full' => [
                    'label' => 'Finance\'s Phone Number',
                    'rules' => 'permit_empty|validatePhoneNumber',
                    'errors' => [
                        // 'required' => '{field} field is required'
                        'validatePhoneNumber' => 'Invalid Phone Number'
                    ]
                ],
                'email-finance-company' => [
                    'label' => 'Finance\'s Email',
                    'rules' => 'permit_empty|valid_email',
                    'errors' => [
                        // 'required' => '{field} field is required'
                        'valid_email' => 'Please enter a valid email address'
                    ]
                ],

                // Engineering Affairs Information
                'company-engineering-name' => [
                    'label' => 'Engineer\'s Name',
                    'rules' => 'permit_empty|alpha_space',
                    'errors' => [
                        // 'required' => '{field} field is required'
                        'alpha_space' => 'Please enter alphabets only'
                    ]
                ],
                'engineering-position-company' => [
                    'label' => 'Engineer\'s Position',
                    'rules' => 'permit_empty',
                    'errors' => [
                        // 'required' => '{field} field is required'
                    ]
                ],
                'phone-engineering-company.full' => [
                    'label' => 'Engineer\'s Phone Number',
                    'rules' => 'permit_empty|validatePhoneNumber',
                    'errors' => [
                        // 'required' => '{field} field is required'
                        'validatePhoneNumber' => 'Invalid Phone Number'
                    ]
                ],
                'email-engineering-company' => [
                    'label' => 'Engineer\'s Email',
                    'rules' => 'permit_empty|valid_email',
                    'errors' => [
                        // 'required' => '{field} field is required'
                        'valid_email' => 'Please enter a valid email address'
                    ]
                ],

                // General Affairs Information
                'company-general-name' => [
                    'label' => 'General Affairs Name',
                    'rules' => 'permit_empty|alpha_space',
                    'errors' => [
                        'alpha_space' => 'Please enter alphabets only'
                    ]
                ],
                'general-position-company' => [
                    'label' => 'General Affairs Position',
                    'rules' => 'permit_empty',
                    'errors' => [
                        // 'required' => '{field} field is required'
                    ]
                ],
                'phone-general-company.full' => [
                    'label' => 'General Affairs Phone Number',
                    'rules' => 'permit_empty|validatePhoneNumber',
                    'errors' => [
                        // 'required' => '{field} field is required'
                        'validatePhoneNumber' => 'Invalid Phone Number'
                    ]
                ],
                'email-general-company' => [
                    'label' => 'General Affairs Email',
                    'rules' => 'permit_empty|valid_email',
                    'errors' => [
                        // 'required' => '{field} field is required'
                        'valid_email' => 'Please enter a valid email address'
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
                'suggestion' => [
                    'label' => 'Suggestion',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                // Validator with rules
                $validation = \Config\Services::validation();

                return redirect()->back()->withInput()->with('validation', $validation);
            } else {

                // Company Profile fields
                $company_profile = [
                    'name_company' => $this->request->getPost('company-name'),
                    'address_company' => $this->request->getPost('address-company'),
                    'phone' => $this->request->getPost('phone-company[full]'),
                    'facsimile' => $this->request->getPost('facsimile'),
                    'email_company' => $this->request->getPost('email-company'),
                    'date_of_establishment' => $this->request->getPost('establishment')
                ];

                // Leader Company fields
                $company_leader = [
                    'name_company_leader' => $this->request->getPost('company-leader-name'),
                    'position' => $this->request->getPost('leader-position-company'),
                    'phone' => $this->request->getPost('phone-leader-company[full]'),
                    'email' => $this->request->getPost('email-leader-company'),
                ];

                // Company Finance fields
                $company_finance = [
                    'name_company_finance' => !empty($this->request->getPost('company-finance-name')) ? $this->request->getPost('company-finance-name') : NULL,
                    'position' => !empty($this->request->getPost('finance-position-company')) ? $this->request->getPost('finance-position-company') : NULL,
                    'phone' => !empty($this->request->getPost('phone-finance-company[full]')) ? $this->request->getPost('phone-finance-company[full]') : NULL,
                    'email' => !empty($this->request->getPost('email-finance-company')) ? $this->request->getPost('email-finance-company') : NULL,
                ];

                $company_engineering = [
                    'name_company_engineering' => !empty($this->request->getPost('company-engineering-name')) ? $this->request->getPost('company-engineering-name') : NULL,
                    'position' => !empty($this->request->getPost('engineering-position-company')) ? $this->request->getPost('engineering-position-company') : NULL,
                    'phone' => !empty($this->request->getPost('phone-engineering-company[full]')) ? $this->request->getPost('phone-engineering-company[full]') : NULL,
                    'email' => !empty($this->request->getPost('email-engineering-company')) ? $this->request->getPost('email-engineering-company') : NULL,
                ];

                // Company General Fields
                $company_general = [
                    'name_company_general' => !empty($this->request->getPost('company-general-name')) ? $this->request->getPost('email-engineering-company') : NULL,
                    'position' => !empty($this->request->getPost('general-position-company')) ? $this->request->getPost('general-position-company') : NULL,
                    'phone' => !empty($this->request->getPost('phone-general-company[full]')) ? $this->request->getPost('general-position-company') : NULL,
                    'email' => !empty($this->request->getPost('email-general-company')) ? $this->request->getPost('general-position-company') : NULL,
                ];


                // Insert Data for Company Profile and Get Insert ID
                $this->M_CompanyProfile->save($company_profile);
                $id_company_profile = $this->M_CompanyProfile->getInsertID();

                // Insert Data for Company Leader and Get Insert ID
                $this->M_CompanyLeader->save($company_leader);
                $id_company_leader = $this->M_CompanyLeader->getInsertID();

                // Insert Data for Company Finance and Get Insert ID
                $this->M_CompanyFinance->save($company_finance);
                $id_company_finance = $this->M_CompanyFinance->getInsertID();

                // Insert Data for Company Engineering and Get Insert ID
                $this->M_CompanyEngineering->save($company_engineering);
                $id_company_engineering = $this->M_CompanyEngineering->getInsertID();

                // Insert Data for Company General and Get Insert ID
                $this->M_CompanyGeneral->save($company_general);
                $id_company_general = $this->M_CompanyGeneral->getInsertID();

                // Data For Update on Customer Tables
                $data_customer = [
                    'id_company_profile' => $id_company_profile,
                    'id_company_leader' => $id_company_leader,
                    'id_company_finance' => $id_company_finance,
                    'id_company_engineering' => $id_company_engineering,
                    'id_company_general' => $id_company_general,
                    'name_customer' => $this->request->getPost('cust-name'),
                    'address_customer' => $this->request->getPost('cust-address'),
                    'id_tariff' => $this->request->getPost('tariff'),
                    'power' => $this->request->getPost('power'),
                    'id_type_of_service' => $this->request->getPost('recommend-service'),
                    'id_status' => 2,
                    'id_information' => 2,
                    'captive_power' => $this->request->getPost('captive-power'),
                    'amount_of_power' => $this->request->getPost('amount-of-power'),
                    'suggestion' => $this->request->getPost('suggestion')
                ];

                try {
                    $rejuvenation = $this->M_Customer->update($id_customer, $data_customer);
                } catch (\Exception $e) {
                    return redirect()->back()->with('message', '<div class="alert alert-danger" role="alert">' . $this->M_Customer->errors() . '</div>');
                }

                if ($rejuvenation) {
                    return redirect()->to(site_url('account-executive'))->with('message', '<div class="alert alert-success" role="alert">Data successfully added!</div>');
                } else {
                    return redirect()->back()->with('message', '<div class="alert alert-danger" role="alert">' . $this->M_Customer->errors() . '</div>');
                }
            }
        }
    }
}
