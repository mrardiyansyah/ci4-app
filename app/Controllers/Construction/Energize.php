<?php

namespace App\Controllers\Construction;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\M_Customer;
use App\Models\CustomerModel;
use App\Models\M_Role;
use App\Models\M_Directories;
use App\Models\M_Files;
use App\Models\M_UserReport;
use App\Models\M_CancellationReport;

class Energize extends BaseController
{
    protected $M_Auth, $M_Role, $M_Customer, $M_Directories, $M_Files, $M_UserReport, $M_CancellationReport, $CustomerModel;

    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_Customer = new M_Customer();
        $this->M_Directories = new M_Directories();
        $this->M_Files = new M_Files();
        $this->M_UserReport = new M_UserReport();
        $this->M_CancellationReport = new M_CancellationReport();
        $db = db_connect();
        $this->CustomerModel = new CustomerModel($db);
    }

    public function index($id_customer)
    {
        $session = session();
        $data['title'] = 'Energize Form';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['customer'] = $this->CustomerModel->getCustomerById($id_customer);
        $data['validation'] = \Config\Services::validation();

        return view('construction/energize', $data);
    }

    public function addEnergize($id_customer)
    {
        $session = session();

        $rules = [
            'ba_aco' => [
                'label' => 'Record of ACO Installation',
                'rules' => 'uploaded[ba_aco.0]|max_size[ba_aco,10240]|mime_in[ba_aco,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} field is required',
                    'is_image' => 'Uploaded files are not Image files.',
                    'max_size' => 'Allowed maximum size is 10MB',
                    'mime_in' => 'The File type is not allowed. Allowed types : .pdf'
                ],
            ],
            'wo_energize' => [
                'label' => 'Work Order',
                'rules' => 'uploaded[wo_energize.0]|max_size[wo_energize,4096]|mime_in[wo_energize,application/pdf',
                'errors' => [
                    'uploaded' => '{field} field is required',
                    'is_image' => 'Uploaded files are not Image files.',
                    'max_size' => 'Allowed maximum size is 4MB',
                    'mime_in' => 'The File type is not allowed. Allowed types : .pdf'
                ],
            ],
            'images' => [
                'label' => 'Images',
                'rules' => 'uploaded[images]|max_size[images,4096]|is_image[images]|mime_in[images,image/gif,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => '{field} field is required',
                    'is_image' => 'Uploaded files are not Image files.',
                    'max_size' => 'Allowed maximum size is 4MB',
                    'mime_in' => 'The Image type is not allowed. Allowed types : gif, jpeg, png'
                ],
            ],
            'notes' => [
                'label' => 'Notes',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} field is required'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            // Validator with rules
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
            // dd($validation);
        } else {
            $cust_name = $this->request->getPost('customer');

            // Get Uploaded Files
            $file = $this->request->getFiles();

            // Type of Report
            $description = 'Construction Log';

            // Call Upload Files Function
            $id_directories = $this->uploadFiles($file, $cust_name, $description);

            if ($id_directories) {

                // dd($id_directories);
                $ReportData = [
                    'id_user' => $session->get('id_user'),
                    'id_customer' => (int) $id_customer,
                    'id_directories' => $id_directories,
                    'date_report' => $this->request->getPost('date_report'),
                    'start_time' => $this->request->getPost('start_time'),
                    'end_time' => $this->request->getPost('end_time'),
                    'description' => $this->request->getPost('description'),
                ];

                try {
                    $this->M_UserReport->save($ReportData);
                } catch (\Exception $e) {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Report Log failed to add! Please try again ' . $this->M_UserReport->errors() . '</div>');
                    return redirect()->to(site_url("construction"));
                }

                $session->setFlashdata('message', '<div class="alert alert-success" role="alert">Report Log added Successfully!</div>');
                return redirect()->to(site_url("construction"));
            } else {
                $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Report Log failed to add! Please try again</div>');
                return redirect()->to(site_url("construction"));
            }
        }
    }

    protected function uploadFiles($files, $cust_name, string $description)
    {
        $session = session();

        //Nama Folder berkas didalam struktur assets
        $structure = "assets/berkas/energize";

        if ($description == 'Record of ACO Installation') {
            $FolderPath = 'ba_aco/'; //Nama Folder Salesman Log Report
            $files = $files['ba_aco'];
        } else if ($description == 'Record of Installation') {
            $FolderPath = 'ba_penyambungan/'; //Nama Folder Cancellation Report
            $files = $files['ba_penyambungan'];
        } else if ($description == 'Work Order') {
            $FolderPath = 'wo_energize/'; //Nama Folder Surat Perintah Kerja
            $files = $files['work_order'];
        } else if ($description == 'Documentation of Energizing') {
            $FolderPath = 'documentation/'; //Nama Folder Surat Perintah Kerja
            $files = $files['images'];
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
                return redirect()->to(site_url("construction"));
            }
        }

        // Direktori Folder Salesman Log Report
        $reportDirectoryName = $structure . $cust_name . '/' . $FolderPath;

        foreach ($files as $file) {
            //Original File Name
            $originalFileName = $file->getClientName();

            //Nama images yang akan disimpan "
            $fileName = $file->getRandomName();

            // Size images
            $size_file = $file->getSize();

            // Mime type 
            $mime_type = $file->getMimeType();

            // File Path
            $file_path = "$reportDirectoryName$fileName";

            // ID Directories
            $dir = $this->M_Directories->where('full_path', $reportDirectoryName)->first();
            $id_dir = $dir['id_dir'];

            // Memindahkan images kedalam Direktori yang telah ditentukan
            if ($file->isValid() && !$file->hasMoved()) {
                $file->move($reportDirectoryName, $fileName, TRUE);
            } else {
                // Jika gagal memindahkan return FALSE
                return false;
                break;
            }

            $data = [
                'id_dir' => $id_dir,
                'id_uploadedby' => $session->get('id_user'),
                'original_file_name' => $originalFileName,
                'storage_file_name' => $fileName,
                'size' => $size_file,
                'mime_type' => $mime_type,
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

        // Jika berhasil memindahkan semua file yang di upload return ID Directories
        return $id_dir;
    }
}
