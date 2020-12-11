<?php

namespace App\Controllers\Managers;

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

class ReportApproval extends BaseController
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

    public function approve()
    {
        $session = session();
        if ($this->request->isAJAX()) {
            $id_user_report = $this->request->getPost();
            // echo json_encode(['id' => $id_user_report]);
            try {
                $status = [
                    'id_approval_status' => 2
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

    public function reject()
    {
        $session = session();
        if ($this->request->isAJAX()) {
            $id_user_report = $this->request->getPost();
            // echo json_encode(['id' => $id_user_report]);
            try {
                $status = [
                    'id_approval_status' => 3
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
}
