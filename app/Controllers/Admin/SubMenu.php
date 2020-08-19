<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\M_Menu;
use App\Models\M_SubMenu;
use App\Models\CustomModel;
use App\Models\M_Role;

class SubMenu extends BaseController
{
    public function index()
    {
        $session = session();
        $M_Auth = new M_Auth();
        $M_Menu = new M_Menu();

        $db = db_connect();
        $CustomModel = new CustomModel($db);
        $M_Role = new M_Role();
        $data['title'] = 'Sub Menu Manajemen';
        $data['user'] = $M_Auth->find($session->get('id_user'));
        $data['role'] =  $M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['menu'] = $M_Menu->findAll();
        $data['subMenu'] = $CustomModel->getAllSubMenu();


        return view('menu/submenu', $data);
    }

    public function add()
    {
        $session = session();
        $M_SubMenu = new M_SubMenu();

        $rules = [
            'title' => [
                'label' => 'Sub Menu Title',
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Sub Menu Title is required',
                    'alpha_space' => 'Sub Menu Title must be alphabetic'
                ]
            ],
            'id_user_menu' => [
                'label' => 'Menu',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Menu field is required'
                ]
            ],
            'url' => [
                'label' => 'URL',
                'rules' => 'required',
            ],
            'icon' => [
                'label' => 'Icon',
                'rules' => 'required',
            ],
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">' . $this->validator->listErrors() . '</div>');
            echo 'gagal';
            return redirect()->back();
        } else {
            $data = [
                'title' => $this->request->getPost('title'),
                'id_user_menu' => $this->request->getPost('id_user_menu'),
                'url' => $this->request->getPost('url'),
                'icon' => $this->request->getPost('icon'),
                'is_active_menu' => $this->request->getPost('is_active_menu'),
            ];
            // dd($data);
            $M_SubMenu->save($data);
            $session->setFlashdata('message', '<div class="alert alert-success" role="alert">
                   Sub Menu has been Added!</div>');
            return redirect()->route('submenu');
        }
    }

    public function editSubMenuModal()
    {
        $M_Menu = new M_Menu();
        $M_SubMenu = new M_SubMenu();

        $id = $this->request->getPost('id');
        $data['row_submenu'] = $M_SubMenu->find($id);
        echo json_encode($data['row_submenu']);
    }

    public function edit()
    {
        $session = session();
        $M_SubMenu = new M_SubMenu();

        $rules = [
            'title' => [
                'label' => 'Sub Menu Title',
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Sub Menu Title is required',
                    'alpha_space' => 'Sub Menu Title must be alphabetic'
                ]
            ],
            'id_user_menu' => [
                'label' => 'Menu',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Menu field is required'
                ]
            ],
            'url' => [
                'label' => 'URL',
                'rules' => 'required',
            ],
            'icon' => [
                'label' => 'Icon',
                'rules' => 'required',
            ],
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">' . $this->validator->listErrors() . '</div>');
            return redirect()->back();
        } else {
            $id_user_sub_menu = $this->request->getPost('id_user_sub_menu');
            $data = [
                'title' => $this->request->getPost('title'),
                'id_user_menu' => $this->request->getPost('id_user_menu'),
                'url' => $this->request->getPost('url'),
                'icon' => $this->request->getPost('icon'),
                'is_active_menu' => $this->request->getPost('is_active_menu'),
            ];
            // dd($data);
            $M_SubMenu->update($id_user_sub_menu, $data);
            $session->setFlashdata('message', '<div class="alert alert-success" role="alert">
                   Sub Menu has been Updated!</div>');
            return redirect()->route('submenu');
        }
    }

    public function delete($id_user_sub_menu)
    {
        $session = session();
        $M_SubMenu = new M_SubMenu();
        $uri = service('uri');
        $uri_id_menu = $uri->getSegment(3);
        if (filter_var($uri_id_menu, FILTER_VALIDATE_INT)) {
            $check = $M_SubMenu->find($id_user_sub_menu);
            if ($check) {
                $M_SubMenu->delete($id_user_sub_menu);
                return redirect()->back()->with('message', '<div class="alert alert-success" role="alert">
                        Menu \'' . $check['title'] . '\' has been Deleted!</div>');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Menu is not found. Please check again!');
            }
        } else {
            return redirect()->back()->with('message', '<div class="alert alert-danger" role="alert">Please check again!</div>');
        }
        // $M_Menu->delete($id_user_menu);
    }
}
