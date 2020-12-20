<?php

namespace App\Controllers\Managers;

use App\Controllers\BaseController;
use App\Models\M_Files;
use App\Models\M_UserEnergize;

class DataEnergize extends BaseController
{
    protected $M_UserEnergize, $M_Files;


    public function __construct()
    {
        $this->M_Files = new M_Files();
        $this->M_UserEnergize = new M_UserEnergize();
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
