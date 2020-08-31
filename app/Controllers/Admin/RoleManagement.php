<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Role;

class RoleManagement extends BaseController
{
    protected $M_Role;

    public function __construct()
    {
        $this->M_Role = new M_Role();
    }

    public function index()
    {
        $session = session();

        $data['title'] = 'Role Management';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['menu'] = $this->M_Role->findAll();



        return view('role_management/role', $data);
    }
}
