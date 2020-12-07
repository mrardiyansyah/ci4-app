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
        $data['notif'] = get_new_notif();

        $role = 'Construction';

        // All Problem Report
        $data['problem_report'] = $this->M_CancellationReport->getCancellationReportByRole($role);

        return view('managers/listProblemReport', $data);
    }

    public function dataProblemReport($id_report)
    {
        $session = session();
        if ($this->request->isAJAX()) {
            try {
                $report = $this->M_CancellationReport->getReportLogById($id_report);

                $dir = $this->M_Directories->find($report['id_directories']);

                $images = $this->M_Files->getAllInfoFileFromDirectories($dir['id_dir']);

                if (!empty($report) && !empty($images)) {
                    echo json_encode([
                        'success' => 'success',
                        'data' => $report,
                        'images' => $images
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
                $report = $this->M_UserReport->update($id_user_report, $status);

                if ($report) {
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
        $data['notif'] = get_new_notif();

        $data['list_status'] = $this->CustomerModel->getApprovalStatus();

        // All Problem Report
        $data['problem_report'] = $this->M_CancellationReport->getReportLogById($id_report);

        d($data['problem_report']);

        return view('managers/problemSolution', $data);
    }
}
