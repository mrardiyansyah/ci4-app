<?php

namespace App\Controllers\Planning;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\CustomerModel;
use App\Models\M_Role;
use App\Models\M_UserClosing;
use App\Models\M_Directories;
use App\Models\M_Files;
use App\Models\M_Customer;
use Exception;

class IncomingRequest extends BaseController
{
    protected $M_Auth, $M_Role, $M_Customer, $M_Directories, $M_Files, $M_UserClosing, $CustomerModel;

    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_Directories = new M_Directories();
        $this->M_Files = new M_Files();
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

    public function processReksis($id_customer)
    {
        $session = session();
        if ($this->request->isAJAX()) {
            try {
                $update_information = $this->M_Customer->update($id_customer, ['id_information' => 4]);

                if ($update_information) {
                    echo json_encode(['success' => 'success']);
                } else {
                    throw new Exception("Error Processing Request", 1);
                }
            } catch (\Exception $e) {
                echo json_encode([
                    'error' => [
                        'message' => $e->getMessage(),
                        'code' => $e->getCode(),
                    ],
                ]);
            }
        }
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
                $cust_name = $data['customer']['name_customer'];

                $file = $this->request->getFiles();
                $description = 'Reksis dan SLD';
                $import = $this->uploadFiles($file, $id_customer, $cust_name, $description);

                if ($import) {
                    $status = [
                        'id_information' => 5,
                    ];

                    try {
                        // Update Status and Information (Closing and Menunggu Reksis)
                        $this->M_Customer->update($id_customer, $status);
                    } catch (\Exception $e) {
                        $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">There something went wrong! ' . $this->M_Customer->errors() . '</div>');
                        return redirect()->to(site_url("planning/request-potential"));
                    }

                    $session->setFlashdata('message', '<div class="alert alert-success" role="alert">Recommendation System and SLD successfully uploaded!</div>');
                    return redirect()->to(site_url("planning/incoming-request"));
                } else {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Failed to Upload Reksis! Please try again</div>');
                    return redirect()->to(site_url("planning/request-potential"));
                }
            }
        }
        return view('planning/upload_reksis', $data);
    }

    protected function uploadFiles($files, $id_customer, $cust_name, string $description)
    {
        $session = session();
        $structure = "assets/berkas/"; //Nama Folder berkas didalam struktur assets

        if ($description == 'Reksis dan SLD') {
            $FolderPath = 'reksis_sld/'; //Nama Folder REKSIS dan SLD
            $file_uploaded = $files['reksisSLD'];
            $localFileName = 'reksis_sld'; //Nama Local File
            $id_closing = 'id_reksis_sld';
        } else {
            return false;
        }

        /* 
        Menghapus special karakter pada string karena terdapat beberapa Nama Customer / Perusahan
        */
        $cust_name = preg_replace("/[^a-zA-Z0-9_ -]/", '', $cust_name);

        // Membuat Folder "berkas" didalam folder assets jika belum ada
        if (!is_dir($structure)) {
            mkdir($structure, 0755);
        }

        // Membuat Folder dengan Nama Customer didalam folder berkas jika belum ada
        if (!is_dir($structure . $cust_name)) {
            mkdir($structure . $cust_name, 0755);
        }

        // // Membuat Folder REKSIS DAN SLD didalam folder dengan nama customer
        if (!file_exists($structure . $cust_name . '/' . $FolderPath)) {
            mkdir($structure . $cust_name . '/' . $FolderPath, 0755);

            $directories_data = [
                'dir_name' =>  $cust_name . '/' . $FolderPath,
                'full_path' => $structure . $cust_name . '/' . $FolderPath
            ];

            try {
                $this->M_Directories->save($directories_data);
            } catch (\Exception $e) {
                $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">There something went wrong! ' . $this->M_Directories->errors() . '</div>');
                return redirect()->to(site_url("account-executive"));
            }
        }

        // Direktori Folder Reksis SLD
        $reportDirectoryName = $structure . $cust_name . '/' . $FolderPath;


        foreach ($file_uploaded as $file) {
            //Original File Name
            $originalFileName = $file->getClientName();

            // Nama file yang akan disimpan
            $ext = $file->getExtension();
            $string = random_string('alnum', 12) . "_" . preg_replace('/\s/', '_', strtolower($cust_name)) . "_";
            $file_name = "$string$localFileName.$ext";

            // Size file
            $size_file = $file->getSize();

            // File Path
            $file_path = "$reportDirectoryName$file_name";

            // ID Directories
            $dir = $this->M_Directories->where('full_path', $reportDirectoryName)->first();
            $id_dir = $dir['id_dir'];

            // Memindahkan file kedalam Direktori yang telah ditentukan
            if ($file->isValid() && !$file->hasMoved()) {
                $file->move($reportDirectoryName, $file_name, TRUE);
            } else {
                // Jika gagal memindahkan return FALSE
                return false;
                break;
            }

            $data = [
                'id_dir' => $id_dir,
                'id_uploadedby' => $session->get('id_user'),
                'original_file_name' => $originalFileName,
                'storage_file_name' => $file_name,
                'size' => $size_file,
                'file_path' => $file_path,
                'description' => $description,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ];

            $input_data[] = $data;
        }

        $insertDataFiles = $this->M_Files->insertBatch($input_data);

        if (!$insertDataFiles) {
            return false;
        }

        $data_closing = [
            'id_user_planning' => $session->get('id_user'),
            "$id_closing" => $id_dir,
        ];

        $insertUserClosing = $this->M_UserClosing
            ->set($data_closing)
            ->where('id_customer', $id_customer)
            ->update();

        if (!$insertUserClosing) {
            return false;
        }

        // Jika berhasil memindahkan semua file yang di upload, return TRUE
        return true;
    }
}
