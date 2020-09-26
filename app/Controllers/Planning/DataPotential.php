<?php

namespace App\Controllers\Planning;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\CustomerModel;
use App\Models\M_Role;
use App\Models\M_Customer;
use Exception;

class DataPotential extends BaseController
{
    protected $M_Auth, $M_Role, $M_Customer, $CustomerModel;


    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_Customer = new M_Customer();
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

        // Data Semua customer
        $data['customer'] = $this->CustomerModel->getCustomer();

        return view('planning/index', $data);
    }

    public function detailCustomer($id_customer)
    {
        $session = session();

        // Data Semua customer
        $data['customer'] = $this->CustomerModel->getCustomerById($id_customer);

        if (!isset($data['customer'])) {
            return redirect()->to(site_url('planning'));
        }

        $data['title'] = 'Detail Customer';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        return view('planning/detail_customer', $data);
    }

    public function editCustomer($id_customer)
    {
        $session = session();

        $data['customer'] = $this->CustomerModel->getCustomerById($id_customer);
        if (!isset($data['customer'])) {
            return redirect()->to(site_url('planning'))->with('message', '<div class="alert alert-danger" role="alert">Data is not found!</div>');
        }

        $data['title'] = 'Edit Customer';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['service'] = $this->CustomerModel->getService();
        $data['substation'] = $this->CustomerModel->getSubstation();
        $data['feeder_substation'] = $this->CustomerModel->getFeederSubstation();
        $data['tariff'] = $this->CustomerModel->getTariff();

        if ($this->request->getMethod() == "put") {

            $rules = [
                'cust-name' => [
                    'label' => 'Customer Name',
                    'rules' => 'required'
                ],
                'id_pelanggan' => [
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
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required'
                    ]
                ],
                'address_customer' => [
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
                // print_r($this->request->getPost());
                $data['validation'] = $this->validator;
            } else {
                $data = [
                    'name_customer' => $this->request->getPost('cust-name'),
                    'id_pelanggan' => $this->request->getPost('cust-id'),
                    'id_tariff' => $this->request->getPost('tariff'),
                    'power' => $this->request->getPost('power'),
                    'address_customer' => $this->request->getPost('address_customer'),
                    'id_substation' => $this->request->getPost('substation'),
                    'id_feeder_substation' => $this->request->getPost('feeder-substation'),
                    'subsistem' => $this->request->getPost('subsistem'),
                    'bep_value' => $this->request->getPost('bep-value'),
                    'id_type_of_service' => $this->request->getPost('recommend-service'),
                ];

                try {
                    $update = $this->M_Customer->update($id_customer, $data);
                } catch (Exception $e) {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">
                    Failed to update Data!</div>');
                    return redirect()->to(site_url("planning/detail-customer/$id_customer"));
                }

                if ($update) {
                    $session->setFlashdata('message', '<div class="alert alert-success" role="alert">
                    Data successfully added!</div>');
                    return redirect()->to(site_url("planning/detail-customer/$id_customer"));
                } else {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">' . $this->M_Customer->errors() . '</div>');
                    return redirect()->to(site_url("planning/detail-customer/$id_customer"));
                }
            }
        }

        return view('planning/edit_customer', $data);
    }

    public function delete($id_customer)
    {
        $session = session();
        $uri = service('uri');
        $uri_id_customer = $uri->getSegment(3);
        if (filter_var($uri_id_customer, FILTER_VALIDATE_INT)) {
            $check = $this->M_Customer->find($id_customer);
            if ($check) {
                $name_customer = $check['name_customer'];
                $data = [
                    'is_deleted' => 1,
                    'id_deletedby' => $session->get('id_user')
                ];
                try {
                    $this->M_Customer->update($id_customer, $data);
                    $this->M_Customer->delete($id_customer);
                    return redirect()->to(site_url('planning'))->with('message', '<div class="alert alert-success" role="alert">Customer \'' . $name_customer . '\' has been Deleted!</div>');
                } catch (Exception $e) {
                    return redirect()->to(site_url('planning'))->with('message', '<div class="alert alert-danger" role="alert">There Something Went Wrong! Please Contact Admin</div>');
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data is not found. Please check again!');
            }
        } else {
            return redirect()->to(site_url('planning'))->with('message', '<div class="alert alert-danger" role="alert">Please check again!</div>');
        }
    }
}
