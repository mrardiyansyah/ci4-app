<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use App\Models\M_Auth;
use App\Models\M_Role;

class UserAccounts extends BaseController
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

        $data['title'] = 'User List';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));

        $db = db_connect();
        $CustomModel = new CustomModel($db);
        $data['all_user'] = $CustomModel->getAllUser();

        return view('admin/user_list', $data);
    }

    public function detailUser($id_user)
    {
        $session = session();

        $data['title'] = 'Detail User';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));

        $data['detail'] = $this->M_Auth->find($id_user);
        $data['detail_role'] = $this->M_Role->find($data['detail']['id_role']);

        return view('admin/detail_user', $data);
    }

    public function add()
    {
        $session = session();
        $rules = [
            'menu' => [
                'label' => 'Menu',
                'rules' => 'required'
            ]
        ];
        if (!$this->validate($rules)) {
            session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">' . $this->validator->getError() . '</div>');
            return redirect()->back();
        }
        $data = ['menu' => $this->request->getPost('menu')];
        $this->M_Menu->save($data);
        $session->setFlashdata('message', '<div class="alert alert-success" role="alert">
                    Menu has been Added!</div>');
        return redirect()->route('menu');
    }

    public function edit()
    {
        if ($this->request->getMethod('POST')) {
            $rules = [
                'menu-name' => [
                    'label' => 'Menu',
                    'rules' => 'required'
                ]
            ];
            if (!$this->validate($rules)) {
                session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">' . $this->validator->getError() . '</div>');
                return redirect()->back();
            } else {
                $id_user_menu = $this->request->getPost('id_menu');
                $menu = $this->request->getPost('menu-name');
                $data = [
                    'menu' => $menu
                ];
                $this->M_Menu->update($id_user_menu, $data);
                session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                        Menu has been Updated!</div>');
                return redirect()->route('menu');
            }
        } else {
            return redirect()->back();
        }
    }

    public function delete($id_user_menu)
    {
        $session = session();
        $uri = service('uri');
        $uri_id_menu = $uri->getSegment(3);
        if (filter_var($uri_id_menu, FILTER_VALIDATE_INT)) {
            $check = $this->M_Menu->find($id_user_menu);
            if ($check) {
                $this->M_Menu->delete($id_user_menu);
                return redirect()->back()->with('message', '<div class="alert alert-success" role="alert">
                        Menu \'' . $check['menu'] . '\' has been Deleted!</div>');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Menu is not found. Please check again!');
            }
        } else {
            return redirect()->back()->with('message', '<div class="alert alert-danger" role="alert">Please check again!</div>');
        }
        // $M_Menu->delete($id_user_menu);
    }
}
