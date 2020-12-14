<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\M_Role;
use CodeIgniter\HTTP\Request;

class Profile extends BaseController
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
        $data['title'] = 'My Profile';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        // $data['notif'] = get_new_notif();

        // $data['message'] = 'test';
        // $this->pusher->trigger('my-channel', 'my-event', $data['message']);
        return view('user/index', $data);
    }

    public function editProfile()
    {
        $session = session();

        $data['title'] = 'Edit Profile';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        // $data['notif'] = get_new_notif();

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'name' => 'required|alpha_space',
                'image' => [
                    'label' => 'Image',
                    'rules' => 'max_size[image,2048]|is_image[image]|mime_in[image,image/gif,image/jpeg,image/png]',
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
                $this->M_Auth->update($id_user, $newData);
                return redirect()->to('profile')->with('message', '<div class="alert alert-success" role="alert">Your Profile has been updated</div>');
            }
        }

        return view('user/edit.php', $data);
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

        $data['title'] = 'Change Password';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        // $data['notif'] = get_new_notif();


        if ($this->request->getMethod() === "put") {
            $rules = [
                'current_password' => [
                    'label' => 'Current Password',
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => 'Current Password is required',
                        'min_length'
                        => 'Password too short! Minimal 8 Characters',
                    ]
                ],
                'new_password1' => [
                    'label' => 'New Password',
                    'rules' => 'required|min_length[8]|regex_match[^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$]|matches[new_password2]',
                    'errors' => [
                        'required' => 'New Password field is required',
                        'min_length'
                        => 'Password too short! Minimal 8 Characters',
                        'regex_match' => "Password must contain at least One Uppercase Letter, One Lowercase Letter and One Number",
                        'matches' => "Those password didn't match!",

                    ]
                ],
                'new_password2' => [
                    'label' => 'Repeat Password',
                    'rules' => 'required',
                    'errors' => ['required' => 'Repeat Password is required']
                ]
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $current_password = $this->request->getPost('current_password');
                $new_password = $this->request->getPost('new_password1');
                if (!password_verify($current_password, $data['user']['password'])) {
                    return redirect()->back()->with('message', '<div class="alert alert-danger" role="alert">Wrong Current Password! Please try again</div>');
                } else if ($current_password == $new_password) {
                    return redirect()->back()->with('message', '<div class="alert alert-danger" role="alert">New Password can\'t be the same as Current Password!</div>');
                } else {
                    $data = [
                        'password' => $new_password
                    ];
                    $id = $this->M_Auth->find($session->get('id_user'));
                    $this->M_Auth->update($id, $data);
                    return redirect()->to('profile')->with('message', '<div class="alert alert-success" role="alert">Your Password changed successfully</div>');
                }
            }
        }

        return view('user/changepassword', $data);
    }
}
