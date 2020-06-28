<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\M_Menu;
use App\Models\M_Role;

class Menu extends BaseController
{
    public function index()
    {
        $session = session();
        $M_Auth = new M_Auth();
        $M_Menu = new M_Menu();
        $M_Role = new M_Role();
        $data['title'] = 'Menu Manajemen';
        $data['user'] = $M_Auth->find($session->get('id_user'));
        $data['role'] =  $M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        $data['menu'] = $M_Menu->findAll();

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
                $M_Menu->save($data);
                $session->setFlashdata('message', '<div class="alert alert-success" role="alert">
                    Menu has been Added!</div>');
                return redirect()->to('menu');
            }
        }

        return view('menu/index', $data);
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
                $M_Menu = new M_Menu();
                $M_Menu->update($id_user_menu, $data);
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
        $M_Menu = new M_Menu();
        $uri = service('uri');
        $uri_id_menu = $uri->getSegment(3);
        if (filter_var($uri_id_menu, FILTER_VALIDATE_INT)) {
            $check = $M_Menu->find($id_user_menu);
            if ($check) {
                $M_Menu->delete($id_user_menu);
                return redirect()->back()->with('message', '<div class="alert alert-success" role="alert">
                        Menu \'' . $check['menu'] . '\' has been Updated!</div>');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Menu is not found. Please check again!');
            }
        } else {
            return redirect()->back()->with('message', '<div class="alert alert-danger" role="alert">Please check again!</div>');
        }
        // $M_Menu->delete($id_user_menu);
    }
}
