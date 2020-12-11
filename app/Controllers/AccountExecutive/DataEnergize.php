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
use App\Models\M_UserEnergize;
use App\Models\M_CancellationReport;

class DataEnergize extends BaseController
{
    protected $M_Auth, $M_Role, $M_Customer, $M_Directories, $M_UserEnergize, $M_Files, $M_UserReport, $M_CancellationReport, $CustomerModel;


    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_Customer = new M_Customer();
        $this->M_Directories = new M_Directories();
        $this->M_Files = new M_Files();
        $this->M_UserEnergize = new M_UserEnergize();
        $this->M_UserReport = new M_UserReport();
        $this->M_CancellationReport = new M_CancellationReport();
        $db = db_connect();
        $this->CustomerModel = new CustomerModel($db);
    }

    public function dataEnergizeDocumentation($id_customer)
    {
        $session = session();
        if ($this->request->isAJAX()) {
            try {

                $id_dir_file_energize = $this->M_UserEnergize->getFileEnergize($id_customer);

                $images = $this->M_Files->getAllInfoFileFromDirectories($id_dir_file_energize['id_documentation']);

                if (!empty($images)) {
                    echo json_encode([
                        'success' => 'success',
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
