<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\M_Role;

class RoleManagement extends BaseController
{
    protected $M_Auth, $M_Role;

    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
    }

    public function index()
    {
        $session = session();

        $data['title'] = 'Role Management';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $current_page = $this->request->getVar('page_user_role') ? $this->request->getVar('page_user_role') : 1;
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $role = $this->M_Role->search($keyword);
        } else {
            $role = $this->M_Role;
        }

        $data['all_role'] = $role->paginate(5, 'user_role');
        $data['pager'] = $this->M_Role->pager;
        $data['current_page'] = $current_page;



        return view('role_management/role', $data);
    }
}
