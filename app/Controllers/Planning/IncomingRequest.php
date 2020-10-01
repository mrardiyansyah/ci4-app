<?php

namespace App\Controllers\Planning;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\CustomerModel;
use App\Models\M_Role;
use App\Models\M_Customer;
use Exception;

class IncomingRequest extends BaseController
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
        $data['title'] = 'Incoming Request';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['request_reksis'] = $this->CustomerModel->getInformationForReksis();
        $data['request_data'] = "";

        return view('planning/incoming_request', $data);
    }

    public function listRequestReksis()
    {
        $session = session();
        $data['title'] = 'Recommendation System Request List';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['request_reksis'] = $this->CustomerModel->getInformationForReksis();

        return view('planning/request_reksis', $data);
    }

    public function uploadReksis($id_customer)
    {
        $session = session();
        $data['title'] = "Upload File Reksis";
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        // Get Data Customer
        $data['customer'] = $this->CustomerModel->getCustomerById($id_customer);

        if ($this->request->getMethod() == "put") {
            $rules = [
                'reksisSLD' => [
                    'label' => 'File Reksis',
                    'rules' => 'uploaded[reksisSLD]|ext_in[reksisSLD,pdf]',
                    'errors' => [
                        'uploaded' => '{field} must be uploaded',
                        'ext_in' => 'File Extension must be .pdf'
                    ]
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $id_salesman = $data['customer']['id_salesman'];
                $cust_name = $data['customer']['name_customer'];
                $file = $this->request->getFileMultiple('reksisSLD');

                d($id_salesman);
                d($cust_name);
                dd($file);
                // $this->importFile($file, $id_salesman, $cust_name);
            }
        }

        return view('planning/upload_reksis', $data);
    }

    protected function importFile($file, $id_salesman, $cust_name)
    {
        (string) $folder = date("Y-m-d H:i:s");
        $datetime = explode(' ', $folder);
        $date = explode('-', $datetime[0]);
        $time = explode(':', $datetime[1]);
        $structure = "assets/berkas/"; //Nama Folder berkas didalam struktur assets
        $reksisSLDFolder = 'Reksis+SLD/'; //Nama Folder REKSIS dan SLD

        // Membuat Folder "berkas" didalam folder assets jika belum ada
        if (!file_exists($structure)) {
            mkdir($structure, 0777);
        }

        // Membuat Folder dengan Nama Customer didalam folder berkas jika belum ada
        if (!file_exists($structure . $cust_name)) {
            mkdir($structure . $cust_name, 0777);
        }

        // Membuat Folder REKSIS DAN SLD didalam folder dengan nama customer
        if (!file_exists($structure . $cust_name . '/' . $reksisSLDFolder)) {
            mkdir($structure . $cust_name . '/' . $reksisSLDFolder, 0777);
        }


        // Direktori Folder Reksis SLD
        $reportDirectoryName = $structure . '/' . $cust_name . '/' . $reksisSLDFolder;
    }
}
