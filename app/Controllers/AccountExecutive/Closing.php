<?php

namespace App\Controllers\AccountExecutive;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\CustomerModel;
use App\Models\M_Role;
use App\Models\M_Customer;
use App\Models\M_UserClosing;
use App\Models\M_Directories;
use App\Models\M_Files;

class Closing extends BaseController
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

    public function index($id_customer)
    {
        $session = session();
        $data['title'] = 'Closing Confirmation';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['customer'] = $this->CustomerModel->getCustomerById($id_customer);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'app_letter' => [
                    'label' => 'Application Letter',
                    'rules' => 'uploaded[app_letter.0]|max_size[app_letter,10240]|mime_in[app_letter,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
                    'errors' => [
                        'uploaded' => '{field} field is required',
                        'is_image' => 'Uploaded files are not Image files.',
                        'max_size' => 'Allowed maximum size is 10MB',
                        'mime_in' => 'The File type is not allowed. Allowed types : .pdf, .doc, .docx'
                    ],
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $cust_name = $data['customer']['name_customer']; //Customer Name
                $description = "Application Letter";

                // Get Files Uploaded by Client
                $files = $this->request->getFiles();

                // Call Upload Files Function to store
                $upload_files = $this->uploadFiles($files, $id_customer, $cust_name, $description);

                if ($upload_files) {
                    $status = [
                        'id_information' => 3,
                        'id_status' => 3
                    ];

                    try {
                        // Update Status and Information (Closing and Menunggu Reksis)
                        $this->M_Customer->update($id_customer, $status);
                    } catch (\Exception $e) {
                        $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">There something went wrong! ' . $this->M_Customer->errors() . '</div>');
                        return redirect()->to(site_url("account-executive"));
                    }

                    $session->setFlashdata('message', '<div class="alert alert-success" role="alert">Application Letter successfully uploaded!</div>');
                    return redirect()->to(site_url("account-executive"));
                } else {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Application Letter failed to upload! Please try again</div>');
                    return redirect()->to(site_url("account-executive"));
                }
            }
        }

        return view('account_executive/closing', $data);
    }

    public function addSpjbtl($id_customer)
    {
        $session = session();
        $data['title'] = 'Upload File SPJBTL';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['customer'] = $this->CustomerModel->getCustomerById($id_customer);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'spjbtl' => [
                    'label' => 'SPJBTL',
                    'rules' => 'uploaded[spjbtl.0]|max_size[spjbtl,10240]|mime_in[spjbtl,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
                    'errors' => [
                        'uploaded' => '{field} field is required',
                        'is_image' => 'Uploaded files are not Image files.',
                        'max_size' => 'Allowed maximum size is 10MB',
                        'mime_in' => 'The File type is not allowed. Allowed types : .pdf, .doc, .docx'
                    ],
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $cust_name = $data['customer']['name_customer']; //Customer Name
                $description = "SPJBTL";

                // Get Files Uploaded by Client
                $files = $this->request->getFiles();

                // Call Upload Files Function to store
                $upload_files = $this->uploadFiles($files, $id_customer, $cust_name, $description);

                if ($upload_files) {
                    $status = [
                        'id_information' => 6,
                    ];

                    try {
                        // Update Status and Information (Closing and Menunggu Reksis)
                        $this->M_Customer->update($id_customer, $status);
                    } catch (\Exception $e) {
                        $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">There something went wrong! ' . $this->M_Customer->errors() . '</div>');
                        return redirect()->to(site_url("account-executive"));
                    }

                    $session->setFlashdata('message', '<div class="alert alert-success" role="alert">SPJBTL successfully uploaded!</div>');
                    return redirect()->to(site_url("account-executive"));
                } else {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">SPJBTL failed to upload! Please try again</div>');
                    return redirect()->to(site_url("account-executive"));
                }
            }
        }

        return view('account_executive/upload_spjbtl', $data);
    }

    public function addWorkingOrder($id_customer)
    {
        $session = session();
        $data['title'] = 'Upload File Working Order';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['customer'] = $this->CustomerModel->getCustomerById($id_customer);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'working_order' => [
                    'label' => 'Working Order',
                    'rules' => 'uploaded[working_order.0]|max_size[working_order,4096]|mime_in[working_order,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
                    'errors' => [
                        'uploaded' => '{field} field is required',
                        'is_image' => 'Uploaded files are not Image files.',
                        'max_size' => 'Allowed maximum size is 4MB',
                        'mime_in' => 'The File type is not allowed. Allowed types : .pdf, .doc, .docx'
                    ],
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $cust_name = $data['customer']['name_customer']; //Customer Name
                $description = "Working Order";

                // Get Files Uploaded by Client
                $files = $this->request->getFiles();

                // Call Upload Files Function to store
                $upload_files = $this->uploadFiles($files, $id_customer, $cust_name, $description);

                if ($upload_files) {
                    $status = [
                        'id_status' => 4,
                        'id_information' => 7,
                    ];

                    try {
                        // Update Status and Information (Closing and Menunggu Reksis)
                        $this->M_Customer->update($id_customer, $status);
                    } catch (\Exception $e) {
                        $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">There something went wrong! ' . $this->M_Customer->errors() . '</div>');
                        return redirect()->to(site_url("account-executive"));
                    }

                    $session->setFlashdata('message', '<div class="alert alert-success" role="alert">Working Order successfully uploaded!</div>');
                    return redirect()->to(site_url("account-executive"));
                } else {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Working Order failed to upload! Please try again</div>');
                    return redirect()->to(site_url("account-executive"));
                }
            }
        }

        return view('account_executive/upload_wo', $data);
    }

    protected function uploadFiles($files, $id_customer, $cust_name, string $description)
    {
        $session = session();

        //Nama Folder berkas didalam struktur assets
        $structure = "assets/berkas/";

        if ($description == 'Application Letter') {
            $FolderPath = 'app_letter/'; //Nama Folder Salesman Log Report
            $file_uploaded = $files['app_letter'];
            $localFileName = 'app_letter'; //Nama Local File
            $id_closing = 'id_app_letter';
        } else if ($description == 'SPJBTL') {
            $FolderPath = 'SPJBTL/'; //Nama Folder Cancellation Report
            $file_uploaded = $files['spjbtl'];
            $localFileName = 'spjbtl'; //Nama Local File
            $id_closing = 'id_spjbtl';
        } else if ($description == 'Working Order') {
            $FolderPath = 'working_order/'; //Nama Folder Cancellation Report
            $file_uploaded = $files['working_order'];
            $localFileName = 'working_order'; //Nama Local File
            $id_closing = 'id_working_order';
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

        // Membuat Folder sesuai dengan Folder Path diatas
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

        // Direktori Folder Salesman Log Report
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

        $id_salesman = $session->get('id_user');

        $data_closing = [
            'id_salesman' => $id_salesman,
            'id_customer' => $id_customer,
            "$id_closing" => $id_dir,
        ];

        if ($description != 'Application Letter') {
            $id_user_closing = $this->M_UserClosing->getID($id_salesman, $id_customer);

            $data_closing['id_user_closing'] = $id_user_closing;
        }

        $insertUserClosing = $this->M_UserClosing->save($data_closing);

        if (!$insertUserClosing) {
            return false;
        }

        // Jika berhasil memindahkan semua file yang di upload return TRUE
        return true;
    }
}
