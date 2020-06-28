<?php

namespace App\Controllers;

use App\Models\M_Auth;
use App\Models\M_Role;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    public function index()
    {
        $data = [];
        if (session()->has('email')) {
            return redirect()->to('users');
        }

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'valid_email' => 'Please enter a valid email address',
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'min_length' => 'Password too short! Minimal 8 Characters',
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                $data['title'] = "Login PLN Layanan Premium";
                echo view('templates/auth_header', $data);
                echo view('auth/login');
                echo view('templates/auth_footer');
            } else {
                return $this->_login();
            }
        } else {
            $data['title'] = "Login PLN Layanan Premium";
            echo view('templates/auth_header', $data);
            echo view('auth/login');
            echo view('templates/auth_footer');
        }
    }

    private function _login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $M_Auth = new M_Auth();
        $user = $M_Auth->where('email', $email)
            ->first();
        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id_user' => $user['id_user'],
                        'email' => $user['email'],
                        'id_role' => $user['id_role'],
                        'name' => $user['name'],
                        'isLoggedIn' => TRUE
                    ];

                    $session = session();
                    $session->set($data);
                    if ($user['id_role'] == 1) {
                        return redirect()->to('admin');
                    }
                } else {
                    $session = session();
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
                    return redirect()->to('login');
                    // print_r($password);
                }
            } else {
                $session = session();
                $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Your Email address has not been Activated! Please contact administrator.</div>');
                return redirect()->to('login');
            }
        } else {
            $session = session();
            $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Your Email address is not registered!</div>');
            return redirect()->to('login');
        }
    }

    public function registration()
    {
        $role = new M_Role();
        $role_type = $role->find([3, 4, 5, 6]);
        $data['role'] = $role_type;
        $data['title'] = "Registration Form";

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'name' => [
                    'rules' => 'required|max_length[25]',
                    'errors' => [
                        'max_length' => 'Name cannot be more than 25 characters long'
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email|is_unique[user.email]',
                    'errors' => [
                        'valid_email' => 'Please enter a valid email address',
                        'is_unique' => 'This Email has already registered!'
                    ]
                ],
                'role_type' => [
                    'label' => 'Role',
                    'rules' => 'in_list[3,4,5,6]',
                    'errors' => [
                        'in_list' => 'Please select a role'
                    ]
                ],
                'password1' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[8]|matches[password2]|regex_match[^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$]',
                    'errors' => [
                        'matches' => "Those password didn't match!",
                        'min_length' => 'Password too short! Minimal 8 Characters',
                        'regex_match' => "Password must contain at least One Uppercase Letter, One Lowercase Letter and One Number"
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $signUp = new M_Auth();

                $signUpData = [
                    'name' => htmlspecialchars($this->request->getVar('name')),
                    'email' => htmlspecialchars($this->request->getVar('email')),
                    'password' => $this->request->getVar('password1'),
                    'image' => 'default.jpg',
                    'id_role' => $this->request->getVar('role_type'),
                    'is_active' => 1
                ];
                $signUp->save($signUpData);
                $session = session();
                $session->setFlashdata('message', '<div class="alert alert-success" role="alert">Your Account has been <strong>Activated</strong>. Please Login</div>');
                return redirect()->route('login');
            }
        }


        echo view('templates/auth_header', $data);
        echo view('auth/registration');
        echo view('templates/auth_footer');
    }

    public function forgotPassword()
    {
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login')->with('message', '<div class="alert alert-success" role="alert">You have been Logged Out!</div>');
    }

    public function blocked()
    {
        return view('auth/blocked');
    }

    //--------------------------------------------------------------------

}
