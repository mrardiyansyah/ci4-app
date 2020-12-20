<?php

namespace App\Controllers\Managers;

use App\Controllers\BaseController;
use App\Models\M_UserReport;

class ReportApproval extends BaseController
{
    protected $M_UserReport;

    public function __construct()
    {
        $this->M_UserReport = new M_UserReport();
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
