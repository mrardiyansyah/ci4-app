<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\M_Role;

class Profile extends BaseController
{
    public function index()
    {
        $session = session();
        $M_Auth = new M_Auth();
        $M_Role = new M_Role();
        $data['title'] = 'My Profile';
        $data['user'] = $M_Auth->find($session->get('id_user'));
        $data['role'] =  $M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('user/index', $data);
        echo view('templates/footer');
    }

    public function editProfile()
    {
        $session = session();
        $M_Auth = new M_Auth();
        $M_Role = new M_Role();
        $data['title'] = 'Edit Profile';
        $data['user'] = $M_Auth->find($session->get('id_user'));
        $data['role'] =  $M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'name' => 'required|alpha_space',
                'image' => [
                    'label' => 'Image',
                    'rules' => 'max_size[image,2048]|mime_in[image,image/gif,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Allowed maximum size is 2MB',
                        'mime_in' => 'The Image type is not allowed. Allowed types : gif, jpeg, png'

                    ],
                ]
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $newData = [];
                // Check jika gambar sudah di upload
                $fileImage = $this->request->getFile('image');
                $id_user = $data['user']['id_user'];

                if ($fileImage->isValid()) {
                    $oldImage = $data['user']['image'];
                    $newData += $this->uploadImage($fileImage, $id_user, $oldImage);
                }

                $newData += [
                    'name' => $this->request->getPost('name'),
                ];

                // return print_r($newData);
                $M_Auth->update($id_user, $newData);
                return redirect()->to('profile')->with('message', '<div class="alert alert-success" role="alert">Your Profile has been updated</div>');
            }
        }

        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('user/edit', $data);
        echo view('templates/footer');
    }

    private function uploadImage($fileImage, $id_user, $oldImage)
    {
        $folderPath = './assets/img/profile/';

        // Check if exist the folder path
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777);
        }

        // Check if exist the user folder path
        if (!file_exists($folderPath . $id_user)) {
            mkdir($folderPath . $id_user, 0777);
        }

        // Check if the image is default pict
        if ($oldImage != 'default.jpg') {
            unlink(FCPATH . 'assets/img/profile/' . $id_user . '/' . $oldImage);
        }

        $path = $folderPath . $id_user;

        if (!$fileImage->hasMoved()) {
            $fileImage->move($path);
        }

        $data = ['image' => $fileImage->getName()];

        return $data;
    }

    public function changePassword()
    {
        $session = session();
        $M_Auth = new M_Auth();
        $M_Role = new M_Role();
        $data['title'] = 'Change Password';
        $data['user'] = $M_Auth->find($session->get('id_user'));
        $data['role'] =  $M_Role->find($session->get('id_role'));
        $data['notif'] = get_new_notif();

        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('user/changepassword', $data);
        echo view('templates/footer');
    }
}
