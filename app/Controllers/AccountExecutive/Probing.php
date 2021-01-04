<?php

namespace App\Controllers\AccountExecutive;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\M_Customer;
use App\Models\CustomerModel;
use App\Models\M_Role;
use App\Models\M_Directories;
use App\Models\M_Files;
use App\Models\M_UserReport;
use App\Models\M_CancellationReport;
use App\Models\M_Notification;


class Probing extends BaseController
{
    protected $M_Auth, $M_Role, $M_Customer, $M_Directories, $M_Files, $M_UserReport, $M_CancellationReport, $M_Notification, $CustomerModel;


    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_Customer = new M_Customer();
        $this->M_Directories = new M_Directories();
        $this->M_Files = new M_Files();
        $this->M_UserReport = new M_UserReport();
        $this->M_CancellationReport = new M_CancellationReport();
        $this->M_Notification = new M_Notification();
        $db = db_connect();
        $this->CustomerModel = new CustomerModel($db);
    }

    public function index($id_customer)
    {
        $session = session();
        $data['title'] = 'Sales Log Form';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));

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
                'discussed' => [
                    'label' => 'Discussed',
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
                $description = 'Salesman Log';

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
                        'description' => $this->request->getPost('discussed'),
                    ];

                    try {
                        $save = $this->M_UserReport->save($ReportData);
                    } catch (\Exception $e) {
                        $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Report Log failed to add! Please try again ' . $this->M_UserReport->errors() . '</div>');
                        return redirect()->to(site_url("account-executive"));
                    }

                    $this->M_Notification->setNotification(
                        $id_customer,
                        $session->get('id_user'),
                        6,
                        'Report',
                        "Report has been received from {$data['user']['name']}. Please kindly check the report.",
                        'Report'
                    );
                    $message = [
                        'message' => 'success'
                    ];
                    $this->pusher->trigger('my-channel', 'my-event', $message);

                    return redirect()->to(site_url("account-executive"))->with('message', '<div class="alert alert-success" role="alert">Report Log added Successfully!</div>');
                } else {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Report Log failed to add! Please try again</div>');
                    return redirect()->to(site_url("account-executive"));
                }
            }
        }

        return view('account_executive/sales_log_form', $data);
    }

    protected function uploadImages($files, $cust_name, string $description)
    {
        $session = session();
        $structure = "assets/berkas/"; //Nama Folder berkas didalam struktur assets

        if ($description == 'Salesman Log') {
            $FolderPath = 'salesman_log_report/'; //Nama Folder Salesman Log Report
        } else if ($description == 'Cancellation') {
            $FolderPath = 'cancellation_report/'; //Nama Folder Cancellation Report
        } else {
            return false;
        }

        /* 
        Menghapus karakter "." (dots) diakhir string karena terdapat beberapa Nama Customer / Perusahan yang dibelakangnya ada titik 
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

        // Membuat Folder Salesman Log Report didalam folder dengan nama customer
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
                return redirect()->to(site_url("account-executive"));
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
            $file_path = "$reportDirectoryName/$fileName";

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
        $data['title'] = 'Cancellation Log Form';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));

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
                    'label' => 'Problem Description',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
                'solution' => [
                    'label' => 'Problem Solution',
                    'rules' => 'permit_empty',
                    // 'errors' => [
                    //     'required' => '{field} field is required'
                    // ]
                ],
                'images' => [
                    'label' => 'Images',
                    'rules' => 'uploaded[images.0]|max_size[images,4096]|is_image[images]|mime_in[images,image/gif,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => '{field} field is required',
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

                // Get Uploaded Files
                $file = $this->request->getFiles();

                // Type of Report
                $description = 'Cancellation';

                // Call Upload Images Function
                $id_directories = $this->uploadImages($file, $cust_name, $description);

                if ($id_directories) {
                    // dd($id_directories);
                    $solutions = $this->request->getPost('solution');
                    $ReportData = [
                        'id_user' => $session->get('id_user'),
                        'id_customer' => (int) $id_customer,
                        'id_directories' => $id_directories,
                        'date_report' => $this->request->getPost('date_report'),
                        'start_time' => $this->request->getPost('start_time'),
                        'end_time' => $this->request->getPost('end_time'),
                        'description' => $this->request->getPost('description'),
                        'suggestion_solution' => (!empty($solutions)) ? $solutions : NULL,
                    ];

                    try {
                        $this->M_CancellationReport->save($ReportData);
                        $this->M_Customer->update($id_customer, ['id_information' => 12]);
                    } catch (\Exception $e) {
                        $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Problem Report failed to add! Please try again ' . $this->M_CancellationReport->errors() . '</div>');
                        return redirect()->to(site_url("account-executive"));
                    }

                    $this->M_Notification->setNotification(
                        $id_customer,
                        $session->get('id_user'),
                        6,
                        'Problem',
                        "Problem Report has been received from {$data['user']['name']}. Please kindly check the report.",
                        'Problem'
                    );
                    $message = [
                        'message' => 'success'
                    ];
                    $this->pusher->trigger('my-channel', 'my-event', $message);

                    $session->setFlashdata('message', '<div class="alert alert-success" role="alert">Problem Report added Successfully! Please wait for confirmation</div>');
                    return redirect()->to(site_url("account-executive"));
                } else {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Problem Report failed to add! Please try again</div>');
                    return redirect()->to(site_url("account-executive"));
                }
            }
        }

        return view('account_executive/cancellation_report', $data);
    }

    public function editProblemLog($id_user_cancellation)
    {
        $session = session();
        $data['title'] = 'Edit Cancellation Log Form';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));

        $data['cancellation_log'] = $this->M_CancellationReport->getReportLogById($id_user_cancellation);

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
                    $description = 'Cancellation';

                    // Call Upload Images Function
                    $id_directories = $this->uploadImages($file, $cust_name, $description);

                    if ($id_directories) {
                        // dd($id_directories);
                        $solutions = $this->request->getPost('solution');
                        $ReportData = [
                            'id_user_cancellation' => $id_user_cancellation,
                            'id_user' => $session->get('id_user'),
                            'id_customer' => (int) $data['cancellation_log']['id_customer'],
                            'id_directories' => $id_directories,
                            'date_report' => $this->request->getPost('date_report'),
                            'start_time' => $this->request->getPost('start_time'),
                            'end_time' => $this->request->getPost('end_time'),
                            'description' => $this->request->getPost('description'),
                            'suggestion_solution' => (!empty($solutions)) ? $solutions : NULL,
                        ];
                    } else {
                        $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Problem Report failed to update! Please try again</div>');
                        return redirect()->to(site_url("account-executive"));
                    }
                } else {
                    $ReportData = [
                        'id_user_cancellation' => $id_user_cancellation,
                        'id_user' => $session->get('id_user'),
                        'id_customer' => (int) $data['cancellation_log']['id_customer'],
                        'date_report' => $this->request->getPost('date_report'),
                        'start_time' => $this->request->getPost('start_time'),
                        'end_time' => $this->request->getPost('end_time'),
                        'description' => $this->request->getPost('description'),
                        'suggestion_solution' => (!empty($solutions)) ? $solutions : NULL,
                    ];
                }

                try {
                    $this->M_CancellationReport->save($ReportData);
                } catch (\Exception $e) {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Problem Report failed to update! Please try again ' . $this->M_CancellationReport->errors() . '</div>');
                    return redirect()->to(site_url("account-executive"));
                }

                return redirect()->to(site_url("account-executive"))->with('message', '<div class="alert alert-success" role="alert">Problem Report has been edited!</div>');
            }
        }

        // d($data['report_log']);
        return view('account_executive/edit_problem_log', $data);
    }

    public function editLog($id_user_report)
    {
        $session = session();
        $data['title'] = 'Edit Report Log';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));

        $data['report_log'] = $this->M_UserReport->getReportLogById($id_user_report);

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
                    $description = 'Salesman Log';

                    // Call Upload Images Function
                    $id_directories = $this->uploadImages($file, $cust_name, $description);

                    if ($id_directories) {
                        // dd($id_directories);
                        $ReportData = [
                            'id_user_report' => $id_user_report,
                            'id_user' => $session->get('id_user'),
                            'id_customer' => (int) $data['report_log']['id_customer'],
                            'id_directories' => $id_directories,
                            'date_report' => $this->request->getPost('date_report'),
                            'start_time' => $this->request->getPost('start_time'),
                            'end_time' => $this->request->getPost('end_time'),
                            'description' => $this->request->getPost('description'),
                        ];
                    } else {
                        $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Report Log failed to update! Please try again</div>');
                        return redirect()->to(site_url("account-executive"));
                    }
                } else {
                    $ReportData = [
                        'id_user_report' => $id_user_report,
                        'id_user' => $session->get('id_user'),
                        'id_customer' => (int) $data['report_log']['id_customer'],
                        'date_report' => $this->request->getPost('date_report'),
                        'start_time' => $this->request->getPost('start_time'),
                        'end_time' => $this->request->getPost('end_time'),
                        'description' => $this->request->getPost('description'),
                    ];
                }

                try {
                    $this->M_UserReport->save($ReportData);
                } catch (\Exception $e) {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Report Log failed to update! Please try again ' . $this->M_UserReport->errors() . '</div>');
                    return redirect()->to(site_url("account-executive"));
                }

                $session->setFlashdata('message', '<div class="alert alert-success" role="alert">Report Log successfully Updated!</div>');
                return redirect()->to(site_url("account-executive"));
            }
        }

        // d($data['account-executive_log']);
        return view('account_executive/edit_log_form', $data);
    }

    public function deleteProblemLog($id_user_cancellation)
    {
        $session = session();
        $uri = service('uri');
        $uri_id_customer = $uri->getSegment(3);
        if (filter_var($uri_id_customer, FILTER_VALIDATE_INT)) {
            $check = $this->M_CancellationReport->find($id_user_cancellation);
            if ($check) {
                try {
                    $this->M_CancellationReport->delete($id_user_cancellation);
                    $this->M_Customer->update($check['id_customer'], ['id_information' => 8]);
                } catch (\Exception $e) {
                    return redirect()->to(site_url('account-executive'))->with('message', '<div class="alert alert-danger" role="alert">There Something Went Wrong! Please Contact Admin</div>');
                }
                return redirect()->to(site_url('account-executive'))->with('message', '<div class="alert alert-success" role="alert">Log has been Deleted!</div>');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data is not found. Please check again!');
            }
        } else {
            return redirect()->to(site_url('account-executive'))->with('message', '<div class="alert alert-danger" role="alert">Please check again!</div>');
        }
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
                    return redirect()->to(site_url('account-executive'))->with('message', '<div class="alert alert-success" role="alert">Log has been Deleted!</div>');
                } catch (\Exception $e) {
                    return redirect()->to(site_url('account-executive'))->with('message', '<div class="alert alert-danger" role="alert">There Something Went Wrong! Please Contact Admin</div>');
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data is not found. Please check again!');
            }
        } else {
            return redirect()->to(site_url('account-executive'))->with('message', '<div class="alert alert-danger" role="alert">Please check again!</div>');
        }
    }
}
