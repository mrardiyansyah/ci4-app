<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\M_Role;
use App\Models\M_Menu;
use App\Models\M_UserAccess;

class RoleManagement extends BaseController
{
    protected $M_Auth, $M_Role, $M_Menu;

    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_Menu = new M_Menu();
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

    public function roleAccess($id_role)
    {
        $session = session();
        $data['title'] = 'Role Management';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($id_role);
        $data['menu'] = $this->M_Menu->where('id_user_menu !=', 1)->findAll();
        $data['notif'] = get_new_notif();

        return view('role_management/role-access', $data);
    }

    public function edit()
    {
        $session = session();

        $id_menu = $this->request->getPost('menuId');
        $id_role = $this->request->getPost('roleId');

        $data = [
            'id_role' => $id_role,
            'id_menu' => $id_menu
        ];

        $M_UserAccess = new M_UserAccess();
        $result = $M_UserAccess->where(['id_menu' => $id_menu, 'id_role' => $id_role])->findAll();

        echo json_encode($result);


        // if (sizeof($result) < 1) {
        //     $M_UserAccess->insert($data);
        //     $session->setFlashdata('message', '<div class="alert alert-success" role="alert">Access Added</div>');
        //     return redirect()->back();
        // } else {
        //     $M_UserAccess->delete($data);
        //     $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Access Removed</div>');
        //     return redirect()->back();
        // }
    }
}
