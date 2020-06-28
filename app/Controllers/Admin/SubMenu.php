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
        $M_SubMenu = new M_SubMenu();
        $db = db_connect();
        $CustomModel = new CustomModel($db);
        $M_Role = new M_Role();
        $data['title'] = 'Sub Menu Manajemen';
        $data['user'] = $M_Auth->find($session->get('id_user'));
        $data['role'] =  $M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['menu'] = $M_Menu->findAll();
        $data['subMenu'] = $CustomModel->getAllSubMenu();

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'menu' => [
                    'label' => 'Menu',
                    'rules' => 'required'
                ]
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $data = ['menu' => $this->request->getPost('menu')];
                $M_SubMenu->save($data);
                $session->setFlashdata('message', '<div class="alert alert-success" role="alert">
                    Menu has been Added!</div>');
                return redirect()->to('menu');
            }
        }

        return view('menu/submenu', $data);
    }
}
