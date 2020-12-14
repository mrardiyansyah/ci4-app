<?php

namespace App\Controllers\Managers\Pemasaran;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\M_Customer;
use App\Models\CustomerModel;
use App\Models\M_Role;
use App\Models\M_Directories;
use App\Models\M_Files;
use App\Models\M_UserEnergize;

class Energize extends BaseController
{
    protected $M_Auth, $M_Role, $M_Customer, $M_Directories, $M_Files, $M_UserEnergize, $CustomerModel;

    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_Customer = new M_Customer();
        $this->M_Directories = new M_Directories();
        $this->M_Files = new M_Files();
        $this->M_UserEnergize = new M_UserEnergize();

        $db = db_connect();
        $this->CustomerModel = new CustomerModel($db);
    }

    public function index($id_customer)
    {
        $session = session();
        $customer = $this->M_Customer->find($id_customer);
        $status = [
            'id_status' => 6,
            'id_information' => 10
        ];
        try {
            $this->M_Customer->update($id_customer, $status);
        } catch (\Exception $e) {
            $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">There\'s something went wrong! Please try again ' . $this->M_Customer->errors() . '</div>');
            return redirect()->to(site_url("manager/pemasaran"));
        }

        $id_salesman = $customer['id_salesman'];
        $id_pengawas = $customer['id_pengawas'];
        $cust_name = $customer['name_customer'];
        $this->M_Notification->setNotification(
            $id_customer,
            $session->get('id_user'),
            $id_salesman,
            'Info',
            "Customer {$cust_name} officialy subscribed Premium Service! Congratulations!!",
            'Info'
        );
        $this->M_Notification->setNotification(
            $id_customer,
            $session->get('id_user'),
            $id_pengawas,
            'Info',
            "Customer {$cust_name} officialy subscribed Premium Service! Congratulations!!",
            'Info'
        );
        $this->M_Notification->setNotification(
            $id_customer,
            $session->get('id_user'),
            5,
            'Info',
            "Customer {$cust_name} officialy subscribed Premium Service! Congratulations!!",
            'Info'
        );
        $message = [
            'message' => 'success'
        ];
        $this->pusher->trigger('my-channel', 'my-event', $message);

        $session->setFlashdata('message', '<div class="alert alert-success" role="alert">' . $customer['name_customer'] . ' has been Energized! Congratulations</div>');
        return redirect()->to(site_url("manager/pemasaran"));
    }
}
