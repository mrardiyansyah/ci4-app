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

        return view('role_management/role-access', $data);
    }

    public function add()
    {
        $session = session();

        $rules = [
            'role' => [
                'title' => 'Role',
                'rules' => 'required|alpha_numeric_space|is_unique[user_role.role_type]',
                'errors' => [
                    'required' => 'Role Name is required',
                    'alpha_numeric_space' => 'Role Name must be alphabetic or numeric',
                    'is_unique' => 'The Role Name already exists. Please enter a different Role Name'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">' . $this->validator->getError('role') . '</div>');
            return redirect()->back();
        } else {
            $data = [
                'role_type' => $this->request->getPost('role')
            ];

            $this->M_Role->save($data);
            $session->setFlashdata('message', '<div class="alert alert-success" role="alert">
                   New Role has been Added!</div>');
            return redirect()->back();
        }
    }

    public function edit()
    {
        $session = session();

        $id_user_menu = $this->request->getPost('menuId');
        $id_role = $this->request->getPost('roleId');

        $data = [
            'id_role' => $id_role,
            'id_user_menu' => $id_user_menu
        ];

        $M_UserAccess = new M_UserAccess();
        $result = $M_UserAccess->where($data)->first();

        if (isset($result)) {
            $id = $result["id_user_access_menu"];
            $delete = $M_UserAccess->delete($id);
            $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Access Removed</div>');
            // echo json_encode($id);
        } else {
            $insert = $M_UserAccess->insert($data);
            $session->setFlashdata('message', '<div class="alert alert-success" role="alert">Access Added</div>');
            // echo json_encode($insert);
        }
    }

    public function delete($id_role)
    {
        $session = session();
        $uri = service('uri');
        $uri_id_role = $uri->getSegment(3);
        if (filter_var($uri_id_role, FILTER_VALIDATE_INT)) {
            $check = $this->M_Role->find($id_role);
            if ($check) {
                $this->M_Role->delete($id_role);
                return redirect()->back()->with('message', '<div class="alert alert-success" role="alert">
                        Role \'' . $check['role_type'] . '\' has been Deleted!</div>');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Role is not found. Please check again!');
            }
        } else {
            return redirect()->back()->with('message', '<div class="alert alert-danger" role="alert">Please check again!</div>');
        }
    }
}
