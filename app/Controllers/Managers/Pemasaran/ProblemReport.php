<?php

namespace App\Controllers\Managers\Pemasaran;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\M_Customer;
use App\Models\CustomerModel;
use App\Models\M_Role;
use App\Models\M_UserClosing;
use App\Models\M_Directories;
use App\Models\M_Files;
use App\Models\M_UserReport;
use App\Models\M_CancellationReport;
use App\Models\M_UserEnergize;

class ProblemReport extends BaseController
{
    protected $M_Auth, $M_Role, $M_Customer, $M_UserClosing, $M_Directories, $M_Files, $M_UserEnergize, $M_UserReport, $M_CancellationReport, $CustomerModel;


    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_Customer = new M_Customer();
        $this->M_UserClosing = new M_UserClosing();
        $this->M_Directories = new M_Directories();
        $this->M_Files = new M_Files();
        $this->M_UserReport = new M_UserReport();
        $this->M_UserEnergize = new M_UserEnergize();
        $this->M_CancellationReport = new M_CancellationReport();
        $db = db_connect();
        $this->CustomerModel = new CustomerModel($db);
    }

    public function index()
    {
        $session = session();
        $data['title'] = 'List Problem Report';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $role = 'Account Executive';

        // All Problem Report
        $data['problem_report'] = $this->M_CancellationReport->getCancellationReportByRole($role);

        return view('managers/listProblemReport', $data);
    }

    public function approve($id_report)
    {
        $session = session();
        $data['title'] = 'Form Approval Problem Report';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['list_status'] = $this->CustomerModel->getApprovalStatus();

        // All Problem Report
        $data['problem_report'] = $this->M_CancellationReport->getReportLogById($id_report);
        // d($data['problem_report']);

        if ($this->request->getMethod() == 'put') {
            $rules = [
                'cancellation_notes' => [
                    'label' => 'Notes',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} field is required'
                    ]
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $cancellation_notes = $this->request->getPost('cancellation_notes');
                $id_customer = $data['problem_report']['id_customer'];

                $approval_status = [
                    'id_approval_status' => 2,
                    'cancellation_notes' => $cancellation_notes
                ];

                $customer_status = [
                    'id_status' => 7,
                    'id_information' => 13
                ];

                try {
                    $update = $this->M_CancellationReport->update($id_report, $approval_status);
                    $this->M_Customer->update($id_customer, $customer_status);
                } catch (\Exception $e) {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Problem Report failed to update! Please try again ' . $this->M_CancellationReport->errors() . '</div>');
                    return redirect()->to(site_url("manager/pemasaran"));
                }
                $session->setFlashdata('message', '<div class="alert alert-success" role="alert">Problem Report rejected!</div>');
                return redirect()->to(site_url("manager/pemasaran"));
            }
        }

        return view('managers/pemasaran/formApproveProblemReport', $data);
    }

    public function reject($id_report)
    {
        $session = session();
        $data['title'] = 'Problem Report';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['list_status'] = $this->CustomerModel->getApprovalStatus();

        // All Problem Report
        $data['problem_report'] = $this->M_CancellationReport->getReportLogById($id_report);
        // d($data['problem_report']);

        if ($this->request->getMethod() == 'put') {
            $id_approval_status = $this->request->getPost('approval_status');
            if ($id_approval_status == 5) {
                $rules = [
                    'solutions' => [
                        'label' => 'Solution',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} field is required'
                        ]
                    ],
                ];
            } else {
                $rules = [
                    'approval_status' => [
                        'label' => 'Status',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} field is required'
                        ]
                    ]
                ];
            }

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $solutions = $this->request->getPost('solutions');
                $id_customer = $data['problem_report']['id_customer'];

                $update_status = [
                    'id_approval_status' => (int) $id_approval_status,
                    'solutions' => (!empty($solutions)) ? $solutions : NULL
                ];

                try {
                    $update = $this->M_CancellationReport->update($id_report, $update_status);
                    $this->M_Customer->update($id_customer, ['id_information' => 8]);
                } catch (\Exception $e) {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Problem Report failed to update! Please try again ' . $this->M_CancellationReport->errors() . '</div>');
                    return redirect()->to(site_url("manager/konstruksi"));
                }
                $session->setFlashdata('message', '<div class="alert alert-success" role="alert">Problem Report rejected!</div>');
                return redirect()->to(site_url("manager/konstruksi"));
            }
        }


        return view('managers/problemSolution', $data);
    }
}
