<?php

namespace App\Controllers\AccountExecutive;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\CustomerModel;
use App\Models\M_Role;
use App\Models\M_SalesReport;

class Probing extends BaseController
{
    protected $M_Auth, $M_Role, $M_SalesReport, $CustomerModel;


    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_SalesReport = new M_SalesReport();
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
                    $id_user_report = $this->M_SalesReport->getInsertID();
                    $file = $this->request->getFiles();
                    $uploadImages = $this->uploadImages($file, $cust_name, $id_user_report);

                    if ($uploadImages) {
                        $session->setFlashdata('message', '<div class="alert alert-success" role="alert">Report Log added Successfully!</div>');
                        return redirect()->to(site_url("account-executive"));
                    } else {
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

    protected function uploadImages($file, $cust_name, $id_user_report)
    {
        $structure = ROOTPATH . "public/assets/berkas/"; //Nama Folder berkas didalam struktur assets
        $logReportFolder = 'salesman_log_report/'; //Nama Folder Salesman Log Report

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
                break;
                return false;
            }
        }
        // Jika berhasil memindahkan semua file yang di upload return TRUE
        return true;
    }
}
