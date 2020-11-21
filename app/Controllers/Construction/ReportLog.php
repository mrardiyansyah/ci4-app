<?php

namespace App\Controllers\Construction;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\M_Customer;
use App\Models\CustomerModel;
use App\Models\M_Role;
use App\Models\M_UserClosing;
use App\Models\M_Directories;
use App\Models\M_Files;
use App\Models\M_UserReport;

class ReportLog extends BaseController
{
    protected $M_Auth, $M_Role, $M_Customer, $M_UserClosing, $M_Directories, $M_Files, $M_UserReport, $CustomerModel;


    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_Customer = new M_Customer();
        $this->M_UserClosing = new M_UserClosing();
        $this->M_Directories = new M_Directories();
        $this->M_Files = new M_Files();
        $this->M_UserReport = new M_UserReport();
        $db = db_connect();
        $this->CustomerModel = new CustomerModel($db);
    }

    public function index($id_customer)
    {
        $session = session();
        $data['title'] = 'Construction Log Form';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['customer'] = $this->CustomerModel->getCustomerById($id_customer);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'date_report' => [
                    'label' => 'Date',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'start_time' => [
                    'label' => 'Start Time',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'end_time' => [
                    'label' => 'End Time',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'description' => [
                    'label' => 'Description',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
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
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $cust_name = $data['customer']['name_customer'];

                // Get Uploaded Files
                $file = $this->request->getFiles();

                // Type of Report
                $description = 'Construction Log';

                // Call Upload Images Function
                $id_directories = $this->uploadImages($file, $cust_name, $description);

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

        return view('construction/log_form', $data);
    }

    protected function uploadImages($files, $cust_name, string $description)
    {
        $session = session();

        //Nama Folder berkas didalam struktur assets
        $structure = "assets/berkas/";

        if ($description == 'Construction Log') {
            $FolderPath = 'construction_log/'; //Nama Folder Salesman Log Report
        } else if ($description == 'Cancellation') {
            $FolderPath = 'cancellation_report/'; //Nama Folder Cancellation Report
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
        if (!is_dir($structure . $cust_name . '/' . $FolderPath)) {
            mkdir($structure . $cust_name . '/' . $FolderPath, 0755);
        }

        $time = time();
        // Membuat Folder sesuai dengan Folder Path diatas
        if (!file_exists($structure . $cust_name . '/' . $FolderPath . $time)) {
            mkdir($structure . $cust_name . '/' . $FolderPath  . $time, 0755);

            $directories_data = [
                'dir_name' =>  $cust_name . '/' . $FolderPath  . $time,
                'full_path' => $structure . $cust_name . '/' . $FolderPath  . $time
            ];

            try {
                $this->M_Directories->save($directories_data);
            } catch (\Exception $e) {
                $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">There something went wrong! ' . $this->M_Directories->errors() . '</div>');
                return redirect()->to(site_url("construction"));
            }
        }

        // Direktori Folder Salesman Log Report
        $reportDirectoryName = $structure . $cust_name . '/' . $FolderPath . $time;

        foreach ($files['images'] as $images) {
            //Original File Name
            $originalFileName = $images->getClientName();

            //Nama images yang akan disimpan "
            $fileName = $images->getRandomName();

            // Size images
            $size_file = $images->getSize();

            // Mime type 
            $mime_type = $images->getMimeType();

            // File Path
            $file_path = "$reportDirectoryName$fileName";

            // ID Directories
            $dir = $this->M_Directories->where('full_path', $reportDirectoryName)->first();
            $id_dir = $dir['id_dir'];

            // Memindahkan images kedalam Direktori yang telah ditentukan
            if ($images->isValid() && !$images->hasMoved()) {
                $images->move($reportDirectoryName, $fileName, TRUE);
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
                'created_at' => date("Y-m-d H:i:s", $time),
                'updated_at' => date("Y-m-d H:i:s", $time),
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

    public function confirmCancellation($id_customer)
    {
        $session = session();
        $data['title'] = 'Cancellation Form';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['customer'] = $this->CustomerModel->getCustomerById($id_customer);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'date_report' => [
                    'label' => 'Date',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'cancellation-reason' => [
                    'label' => 'Reason for Cancellation',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'images' => [
                    'label' => 'Images',
                    'rules' => 'max_size[images,4096]|is_image[images]|mime_in[images,image/gif,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Allowed maximum size is 4MB',
                        'is_image' => 'Uploaded files are not Image files',
                        'mime_in' => 'The Image type is not allowed. Allowed types : gif, jpeg, png'
                    ],
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $cust_name = $data['customer']['name_customer'];

                $ReportData = [
                    'id_salesman' => $session->get('id_user'),
                    'id_customer' => $id_customer,
                    'date_report' => $this->request->getPost('date_report'),
                    'cancellation_reason' => $this->request->getPost('cancellation-reason'),
                ];

                try {
                    // Insert Data Cancellation Report
                    $insertData = $this->M_CancellationReport->save($ReportData);
                } catch (\Exception $e) {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Cancellation Report failed to add! Please try again ' . $this->M_CancellationReport->errors() . '</div>');
                    return redirect()->to(site_url("account-executive"));
                }

                if ($insertData) {
                    // Get Insert ID
                    $id_user_cancellation = $this->M_CancellationReport->getInsertID();

                    // Get Files Uploaded
                    $file = $this->request->getFiles();
                    foreach ($file['images'] as $image) {
                        if (!$image->isValid()) {
                            $status = false;
                            break;
                        }
                        $status = true;
                    }

                    if ($status) {
                        $type_report = 'cancellation';
                        // Call Upload Image function
                        $uploadImages = $this->uploadImages($file, $cust_name, $id_user_cancellation, $type_report);

                        // If failed to upload
                        if (!$uploadImages) {
                            // Delete Last Inserted Data
                            $this->M_CancellationReport->delete($id_user_cancellation);

                            $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Cancellation Report failed to add! Please try again</div>');
                            return redirect()->to(site_url("account-executive"));
                        }
                    }

                    // Update status information customer
                    $this->M_Customer->update($id_customer, ['id_information' => 12]);

                    $session->setFlashdata('message', '<div class="alert alert-success" role="alert">Cancellation Report added Successfully! Please wait for confirmation</div>');
                    return redirect()->to(site_url("account-executive"));
                } else {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Cancellation Report failed to add! Please try again</div>');
                    return redirect()->to(site_url("account-executive"));
                }
            }
        }

        return view('account_executive/cancellation_report', $data);
    }

    public function editLog($id_user_report)
    {
        $session = session();
        $data['title'] = 'Edit Construction Log Form';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['construction_log'] = $this->M_UserReport->getReportLogById($id_user_report);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'date_report' => [
                    'label' => 'Date',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'start_time' => [
                    'label' => 'Start Time',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'end_time' => [
                    'label' => 'End Time',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'description' => [
                    'label' => 'Description',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'images' => [
                    'label' => 'Images',
                    'rules' => 'max_size[images,4096]|is_image[images]|mime_in[images,image/gif,image/jpeg,image/png]',
                    'errors' => [
                        // 'uploaded' => '{field} field is required',
                        'is_image' => 'Uploaded files are not Image files.',
                        'max_size' => 'Allowed maximum size is 4MB',
                        'mime_in' => 'The Image type is not allowed. Allowed types : gif, jpeg, png'
                    ],
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {

                // Get Uploaded Files
                $file = $this->request->getFiles();

                // Check If There's File Uploaded
                if ($file['images'][0]->isValid() === true) {
                    $cust_name = $this->request->getPost('customer');

                    // Description of Report
                    $description = 'Construction Log';

                    // Call Upload Images Function
                    $id_directories = $this->uploadImages($file, $cust_name, $description);

                    if ($id_directories) {
                        // dd($id_directories);
                        $ReportData = [
                            'id_user_report' => $id_user_report,
                            'id_user' => $session->get('id_user'),
                            'id_customer' => (int) $data['construction_log']['id_customer'],
                            'id_directories' => $id_directories,
                            'date_report' => $this->request->getPost('date_report'),
                            'start_time' => $this->request->getPost('start_time'),
                            'end_time' => $this->request->getPost('end_time'),
                            'description' => $this->request->getPost('description'),
                        ];
                    } else {
                        $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Report Log failed to add! Please try again</div>');
                        return redirect()->to(site_url("construction"));
                    }
                } else {
                    $ReportData = [
                        'id_user_report' => $id_user_report,
                        'id_user' => $session->get('id_user'),
                        'id_customer' => (int) $data['construction_log']['id_customer'],
                        'date_report' => $this->request->getPost('date_report'),
                        'start_time' => $this->request->getPost('start_time'),
                        'end_time' => $this->request->getPost('end_time'),
                        'description' => $this->request->getPost('description'),
                    ];
                }

                try {
                    $this->M_UserReport->save($ReportData);
                } catch (\Exception $e) {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Report Log failed to add! Please try again ' . $this->M_UserReport->errors() . '</div>');
                    return redirect()->to(site_url("construction"));
                }

                $session->setFlashdata('message', '<div class="alert alert-success" role="alert">Report Log added Successfully!</div>');
                return redirect()->to(site_url("construction"));
            }
        }

        // d($data['construction_log']);
        return view('construction/edit_log_form', $data);
    }

    public function deleteLog($id_user_report)
    {
        $session = session();
        $uri = service('uri');
        $uri_id_customer = $uri->getSegment(3);
        if (filter_var($uri_id_customer, FILTER_VALIDATE_INT)) {
            $check = $this->M_UserReport->find($id_user_report);
            if ($check) {
                try {
                    $this->M_UserReport->delete($id_user_report);
                    return redirect()->to(site_url('construction'))->with('message', '<div class="alert alert-success" role="alert">Log has been Deleted!</div>');
                } catch (\Exception $e) {
                    return redirect()->to(site_url('construction'))->with('message', '<div class="alert alert-danger" role="alert">There Something Went Wrong! Please Contact Admin</div>');
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data is not found. Please check again!');
            }
        } else {
            return redirect()->to(site_url('construction'))->with('message', '<div class="alert alert-danger" role="alert">Please check again!</div>');
        }
    }
}
