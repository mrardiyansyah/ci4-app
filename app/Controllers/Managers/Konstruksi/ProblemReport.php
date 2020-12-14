<?php

namespace App\Controllers\Managers\Konstruksi;

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

        $role = 'Construction';

        // All Problem Report
        $data['problem_report'] = $this->M_CancellationReport->getCancellationReportByRole($role);

        return view('managers/listProblemReport', $data);
    }

    public function approve()
    {
        $session = session();
        if ($this->request->isAJAX()) {
            $id_user_report = $this->request->getPost();
            // echo json_encode(['id' => $id_user_report]);


            try {
                $status = [
                    'id_approval_status' => 4
                ];

                $cancel = $this->M_CancellationReport->where('id_user_cancellation', $id_user_report)->get()->getRowArray();
                $id_customer = $cancel['id_customer'];
                $report = $this->M_CancellationReport->update($id_user_report, $status);

                if ($report) {
                    $this->M_Notification->setNotification(
                        $id_customer,
                        $session->get('id_user'),
                        6,
                        'Problem',
                        "The Construction Manager passes on a Problem Report for immediate confirmation. Please kindly check the report!",
                        'Problem'
                    );
                    $message = [
                        'message' => 'success'
                    ];
                    $this->pusher->trigger('my-channel', 'my-event', $message);

                    echo json_encode([
                        'success' => 'success',
                        'data' => $report,
                    ]);
                } else {
                    throw new \Exception("Error Processing Request", 1);
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

    public function reject($id_report)
    {
        $session = session();
        $data['title'] = 'Problem Report';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));

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
