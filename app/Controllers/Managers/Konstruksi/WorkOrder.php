<?php

namespace App\Controllers\Managers\Konstruksi;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\M_Customer;
use App\Models\CustomerModel;
use App\Models\M_Role;
use App\Models\M_UserClosing;
use App\Models\M_Directories;
use App\Models\M_Files;

class WorkOrder extends BaseController
{
    protected $M_Auth, $M_Role, $M_Customer, $M_UserClosing, $M_Directories, $M_Files, $CustomerModel;


    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_Customer = new M_Customer();
        $this->M_UserClosing = new M_UserClosing();
        $this->M_Directories = new M_Directories();
        $this->M_Files = new M_Files();
        $db = db_connect();
        $this->CustomerModel = new CustomerModel($db);
    }

    public function index()
    {
        $session = session();
        $data['title'] = 'Work Order Request';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['information'] = $this->CustomerModel->getInformationForWorkingOrder();

        return view('managers/konstruksi/work_order', $data);
    }

    public function detail($id_customer)
    {
        $session = session();
        $data['title'] = 'Customer Profile';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        // Data Semua customer
        $data['customer'] = $this->CustomerModel->getAllInformationCustomerById($id_customer);

        $id_dir_file = $this->M_UserClosing->getDirFileForConstruction($id_customer);
        $data['file_construction'] =
            $this->M_Files->getInfoFileForConstruction($id_dir_file['id_reksis_sld'], $id_dir_file['id_working_order']);

        // Jika sudah ditentukan pengawasnya
        if (!is_null($data['customer']['id_pengawas'])) {
            $data['pengawas'] = $this->M_Auth->find($data['customer']['id_pengawas']);
        }

        $data['user_construction'] = $this->M_Auth->where('id_role', 5)->find();
        // d($data['customer']);
        return view('managers/konstruksi/detail_customer', $data);
    }

    public function pilihPengawas($id_customer)
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'pengawas' => [
                    'label' => 'Pengawas Konstruksi',
                    'rules' => 'required',
                ],
            ];

            if (!$this->validate($rules)) {
                session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">' . $this->validator->listErrors() . '</div>');
                return redirect()->back();
            } else {
                $id_pengawas = $this->request->getPost('pengawas');
                // dd($id_pengawas);
                try {
                    $this->M_Customer->update($id_customer, ['id_pengawas' => $id_pengawas]);
                } catch (\Exception $e) {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">There something went wrong! ' . $this->M_Customer->errors() . '</div>');
                    return redirect()->back();
                }

                $session->setFlashdata('message', '<div class="alert alert-success" role="alert">
                   The Construction Supervisor has been Selected!</div>');
                return redirect()->back();
            }
        } else {
            $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Failed to select The Supervisor!' . '</div>');
            return redirect()->back();
        }
    }
}
