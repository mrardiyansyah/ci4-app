<?php

namespace App\Controllers\Construction;

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
        $data['title'] = 'Energize Form';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['customer'] = $this->CustomerModel->getCustomerById($id_customer);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'ba_aco' => [
                    'label' => 'Record of ACO Installation',
                    'rules' => 'uploaded[ba_aco]|max_size[ba_aco,10240]|mime_in[ba_aco,application/pdf]',
                    'errors' => [
                        'uploaded' => '{field} field is required',
                        'max_size' => 'Allowed maximum size is 10MB',
                        'mime_in' => 'The File type is not allowed. Allowed types : .pdf'
                    ],
                ],
                'working_order' => [
                    'label' => 'Work Order',
                    'rules' => 'uploaded[working_order]|max_size[working_order,10240]|mime_in[working_order,application/pdf]',
                    'errors' => [
                        'uploaded' => '{field} field is required',
                        'max_size' => 'Allowed maximum size is 10MB',
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
                $data['validation'] = $this->validator;
            } else {
                $cust_name = $this->request->getPost('customer');

                // Get Uploaded Files
                $file = $this->request->getFiles();

                $file_ba_aco = $file['ba_aco'];
                $file_wo = $file['working_order'];
                $file_documentation = $file['images'];

                if ($file_ba_aco[0]->isValid()) {
                    $description_ba_aco = 'Record of ACO Installation';
                    $id_directories_ba_aco = $this->uploadFiles($file_ba_aco, $cust_name, $description_ba_aco);
                }

                if ($id_directories_ba_aco != false && $file_wo[0]->isValid()) {
                    $description_wo = 'Work Order Energize';
                    $id_directories_wo = $this->uploadFiles($file_wo, $cust_name, $description_wo);
                } else {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">There something went wrong! Please call the Administrator</div>');
                    return redirect()->to(site_url("construction"));
                }

                if ($id_directories_wo != false && $file_documentation[0]->isValid()) {
                    $description_documentation = 'Documentation of Energizing';
                    $id_directories_documentation = $this->uploadFiles($file_documentation, $cust_name, $description_documentation);
                } else {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">There something went wrong! Please call the Administrator</div>');
                    return redirect()->to(site_url("construction"));
                }

                if ($id_directories_documentation) {

                    // dd($id_directories);
                    $ReportData = [
                        'id_user' => $session->get('id_user'),
                        'id_customer' => (int) $id_customer,
                        'id_ba_aco' => $id_directories_ba_aco,
                        'id_work_order' => $id_directories_wo,
                        'id_documentation' => $id_directories_documentation,
                        'notes' => $this->request->getPost('notes'),
                    ];

                    try {
                        $this->M_UserEnergize->save($ReportData);

                        $status = [
                            'id_status' => 5,
                            'id_information' => 9
                        ];
                        $this->M_Customer->update($id_customer, $status);
                    } catch (\Exception $e) {
                        $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Energize ' . $this->M_UserEnergize->errors() . '</div>');
                        return redirect()->to(site_url("construction"));
                    }

                    $session->setFlashdata('message', '<div class="alert alert-success" role="alert">Energize Report successfully uploaded! Please wait for confirmation to energize</div>');
                    return redirect()->to(site_url("construction"));
                } else {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Energize Report failed to add! Please try again</div>');
                    return redirect()->to(site_url("construction"));
                }
            }
        }

        return view('construction/energize', $data);
    }

    protected function uploadFiles($files, $cust_name, string $description)
    {
        $session = session();

        //Nama Folder berkas didalam struktur assets
        $structure = "assets/berkas/";

        if ($description == 'Record of ACO Installation') {
            $FolderPath = 'ba_aco/'; //Nama Folder Salesman Log Report
        } else if ($description == 'Record of Installation') {
            $FolderPath = 'ba_penyambungan/'; //Nama Folder Cancellation Report
        } else if ($description == 'Work Order Energize') {
            $FolderPath = 'wo_energize/'; //Nama Folder Surat Perintah Kerja
        } else if ($description == 'Documentation of Energizing') {
            $FolderPath = 'documentation/'; //Nama Folder Surat Perintah Kerja
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

        // Membuat Folder dengan Nama Customer didalam folder berkas jika belum ada
        if (!is_dir($structure . $cust_name . '/Energize')) {
            mkdir($structure . $cust_name . '/Energize', 0755);
        }

        // Membuat Folder sesuai dengan Folder Path diatas
        if (!file_exists($structure . $cust_name . '/Energize' . '/' . $FolderPath)) {
            d($structure . $cust_name . '/Energize' . '/' . $FolderPath);
            mkdir($structure . $cust_name . '/Energize' . '/' . $FolderPath, 0755);

            $directories_data = [
                'dir_name' =>  $cust_name . '/Energize' . '/' . $FolderPath,
                'full_path' => $structure . $cust_name . '/Energize' . '/' . $FolderPath
            ];

            try {
                $this->M_Directories->save($directories_data);
            } catch (\Exception $e) {
                $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">There something went wrong! ' . $this->M_Directories->errors() . '</div>');
                return redirect()->to(site_url("construction"));
            }
        }

        // Direktori Folder Salesman Log Report
        $reportDirectoryName = $structure . $cust_name . '/Energize' . '/' . $FolderPath;

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
