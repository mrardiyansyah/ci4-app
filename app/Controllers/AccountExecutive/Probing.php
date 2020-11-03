<?php

namespace App\Controllers\AccountExecutive;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\CustomerModel;
use App\Models\M_Role;
use App\Models\M_Customer;
use App\Models\M_SalesReport;
use App\Models\M_CancellationReport;

class Probing extends BaseController
{
    protected $M_Auth, $M_Role, $M_Customer, $M_SalesReport, $M_CancellationReport, $CustomerModel;


    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_Customer = new M_Customer();
        $this->M_SalesReport = new M_SalesReport();
        $this->M_CancellationReport = new M_CancellationReport();
        $db = db_connect();
        $this->CustomerModel = new CustomerModel($db);
    }

    public function index($id_customer)
    {
        $session = session();
        $data['title'] = 'Sales Log Form';
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

                $ReportData = [
                    'id_salesman' => $session->get('id_user'),
                    'id_customer' => $id_customer,
                    'date_report' => $this->request->getPost('date_report'),
                    'start_time' => $this->request->getPost('start_time'),
                    'end_time' => $this->request->getPost('end_time'),
                    'discussed' => $this->request->getPost('discussed'),
                ];

                try {
                    $insertData = $this->M_SalesReport->save($ReportData);
                } catch (\Exception $e) {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Report Log failed to add! Please try again ' . $this->M_SalesReport->errors() . '</div>');
                    return redirect()->to(site_url("account-executive"));
                }

                if ($insertData) {
                    // Get Last Insert ID (PK)
                    $id_user_report = $this->M_SalesReport->getInsertID();

                    // Get Uploaded Files
                    $file = $this->request->getFiles();

                    // Type of Report
                    $type_report = 'salesman_log';

                    // Call Upload Images Function
                    $uploadImages = $this->uploadImages($file, $cust_name, $id_user_report, $type_report);

                    if ($uploadImages) {
                        $session->setFlashdata('message', '<div class="alert alert-success" role="alert">Report Log added Successfully!</div>');
                        return redirect()->to(site_url("account-executive"));
                    } else {
                        // Delete Last Inserted Data
                        $this->M_SalesReport->delete($id_user_report);

                        $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Report Log failed to add! Please try again</div>');
                        return redirect()->to(site_url("account-executive"));
                    }
                } else {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Report Log failed to add! Please try again</div>');
                    return redirect()->to(site_url("account-executive"));
                }
            }
        }

        return view('account_executive/sales_log_form', $data);
    }

    protected function uploadImages($file, $cust_name, $id_user_report, string $type_report)
    {
        $structure = ROOTPATH . "public/assets/berkas/"; //Nama Folder berkas didalam struktur assets

        if ($type_report == 'salesman_log') {
            $logReportFolder = 'salesman_log_report/'; //Nama Folder Salesman Log Report
        } else if ($type_report == 'cancellation') {
            $logReportFolder = 'cancellation_report/'; //Nama Folder Cancellation Report
        } else {
            return false;
        }

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

        // Membuat Folder Salesman Log Report didalam folder dengan nama customer
        if (!is_dir($structure . $cust_name . '/' . $logReportFolder)) {
            mkdir($structure . $cust_name . '/' . $logReportFolder, 0755);
        }

        // Membuat Folder sesuai dengan Id Report pada database agar memudahkan pencarian data Report Log didalam folder Salesman Log Report
        if (!file_exists($structure . $cust_name . '/' . $logReportFolder . $id_user_report)) {
            mkdir($structure . $cust_name . '/' . $logReportFolder  . $id_user_report, 0755);
        }

        // Direktori Folder Salesman Log Report
        $reportDirectoryName = $structure . $cust_name . '/' . $logReportFolder . $id_user_report;

        foreach ($file['images'] as $images) {
            //Nama file yang akan disimpan "
            $fileName = $images->getRandomName();

            // Memindahkan file kedalam Direktori yang telah ditentukan
            if ($images->isValid() && !$images->hasMoved()) {
                $images->move($reportDirectoryName, $fileName, TRUE);
            } else {
                // Jika gagal memindahkan return FALSE
                return false;
                break;
            }
        }
        // Jika berhasil memindahkan semua file yang di upload return TRUE
        return true;
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
}
