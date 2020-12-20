<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\M_Role;
use App\Models\M_Files;

class Viewer extends BaseController
{

    protected $M_Auth, $M_Role, $M_Files;

    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Files = new M_Files();
        $this->M_Role = new M_Role();
    }

    public function index($id_file)
    {
        $session = session();
        $data['title'] = 'PDF Viewer';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));

        // Data File
        $data['file'] = $this->M_Files->getInfoFile($id_file);

        // d($data['file']);
        return view('files/pdfViewer', $data);
    }
}
