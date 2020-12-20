<?php

namespace App\Controllers\Managers;

use App\Controllers\BaseController;
use App\Models\M_Directories;
use App\Models\M_Files;
use App\Models\M_UserReport;
use App\Models\M_CancellationReport;

class DataProblemReport extends BaseController
{
    protected $M_Directories, $M_Files, $M_UserReport, $M_CancellationReport;


    public function __construct()
    {
        $this->M_Directories = new M_Directories();
        $this->M_Files = new M_Files();
        $this->M_UserReport = new M_UserReport();
        $this->M_CancellationReport = new M_CancellationReport();
    }

    public function dataReport($id_report)
    {
        $session = session();
        if ($this->request->isAJAX()) {
            try {
                $report = $this->M_UserReport->getReportLogById($id_report);

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
}
