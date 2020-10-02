<?php

namespace App\Controllers\Planning;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\CustomerModel;
use App\Models\M_Role;
use App\Models\M_UserClosing;
use App\Models\M_Customer;
use Exception;

class IncomingRequest extends BaseController
{
    protected $M_Auth, $M_Role, $M_Customer, $M_UserClosing, $CustomerModel;

    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_UserClosing = new M_UserClosing();
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
                // Validation
                $data['validation'] = $this->validator;
            } else {
                $id_salesman = $data['customer']['id_salesman'];
                $cust_name = $data['customer']['name_customer'];
                $file = $this->request->getFiles();
                $import = $this->importFile($file, $id_salesman, $cust_name);

                if ($import) {
                    // Timestamp Reksis + SLD Filed for update to database
                    $reksis_sld_field = date("Y-m-d H:i:s");

                    try {
                        $this->M_UserClosing->update($id_customer, ['reksis_sld' => $reksis_sld_field]);
                    } catch (Exception $e) {
                        $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Failed to Upload Reksis! Please try again</div>');
                        return redirect()->to(site_url("planning/request-potential"));
                    }
                } else {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Failed to Upload Reksis! Please try again</div>');
                    return redirect()->to(site_url("planning/request-potential"));
                }
            }
        }
        return view('planning/upload_reksis', $data);
    }

    protected function importFile($file, $id_salesman, $cust_name)
    {
        $structure = ROOTPATH . "public/assets/berkas/"; //Nama Folder berkas didalam struktur assets
        $reksisSLDFolder = 'Reksis+SLD/'; //Nama Folder REKSIS dan SLD

        /* 
        Menghapus karakter "." (dots) diakhir string karena terdapat beberapa Nama Customer / Perusahan yang dibelakangnya ada titik 
        */
        $cust_name = rtrim($cust_name, ".");

        // Membuat Folder "berkas" didalam folder assets jika belum ada
        if (!is_dir($structure)) {
            mkdir($structure, 0755);
        }

        // Membuat Folder dengan Nama Customer didalam folder berkas jika belum ada
        if (!is_dir($structure . $cust_name)) {
            mkdir($structure . $cust_name, 0755);
        }

        // // Membuat Folder REKSIS DAN SLD didalam folder dengan nama customer
        if (!file_exists($structure . $cust_name . '/' . $reksisSLDFolder)) {
            mkdir($structure . $cust_name . '/' . $reksisSLDFolder, 0755);
        }

        // Direktori Folder Reksis SLD
        $reportDirectoryName = $structure . $cust_name . '/' . $reksisSLDFolder;

        $count = 1;
        foreach ($file['reksisSLD'] as $upload) {
            // Regex untuk menggantikan character menjadi '-' dan menjadikan huruf kecil
            $customer = preg_replace('/[^a-zA-Z0-9\']/', '-', strtolower($cust_name));

            // Get Extension
            $ext = $upload->getExtension();

            //Nama file yang akan disimpan
            $fileName = "reksis-sld-$customer($count).$ext";
            $count = $count + 1;

            // Memindahkan file kedalam Direktori yang telah ditentukan
            if ($upload->isValid() && !$upload->hasMoved()) {
                $upload->move($reportDirectoryName, $fileName, TRUE);
            } else {
                // Jika gagal memindahkan return FALSE
                break;
                return false;
            }
        }
        // Jika berhasil memindahkan semua file yang di upload return TRUE
        return true;
    }
}
