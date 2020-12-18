<?php

namespace App\Controllers;

use App\Models\M_Auth;
use App\Models\M_Role;
use App\Models\M_Token;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    public function index()
    {
        $data = [];
        if (session()->has('email')) {
            return redirect()->to('profile');
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
                    } else {
                        return redirect()->to('profile');
                    }
                } else {
                    $session = session();
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
                    return redirect()->to('login');
                    // print_r($password);
                }
            } else {
                $session = session();
                $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Your Email address has not been Activated! Please activate your account or contact Administrator.</div>');
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

                $name = $this->request->getVar('name');
                $email = $this->request->getVar('email');
                $signUpData = [
                    'name' => htmlspecialchars($name),
                    'email' => htmlspecialchars($email),
                    'password' => $this->request->getVar('password1'),
                    'image' => 'default.jpg',
                    'id_role' => $this->request->getVar('role_type'),
                    'is_active' => 0
                ];
                $session = session();

                // Siapkan Token
                //Bin2Hex untuk Konversi String dari karakter ASCII ke nilai Hexadecimal, openssl_random_pseudo_bytes untuk generate token yang aman secara kriptografi.
                $token = bin2hex(openssl_random_pseudo_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token
                ];
                // Kirim token aktifasi lewat email
                $M_Token = new M_Token();
                $M_Token->save($user_token);
                $this->_sendEmail($name, $email, $token, "verify");

                // Insert Data Registrasi
                $signUp->save($signUpData);
                $session->setFlashdata('message', '<div class="alert alert-success" role="alert">Your Account successfully <strong>Registered</strong>. Please check your inbox Email for Activation</div>');
                return redirect()->route('login');
            }
        }
        echo view('templates/auth_header', $data);
        echo view('auth/registration');
        echo view('templates/auth_footer');
    }

    public function _sendEmail($name, $email, $token, $type)
    {
        // Fungsi Kirim email Aktivasi atau Forgot Password

        $session = session();
        $startDate = time();

        $to = $email;
        if ($type == 'verify') {
            $subject = "Account Verification Layanan Premium PLN DISJAYA";
            $message = 'Hi ' . $name . ', <br><br> Thanks, Your account created successfully. Please click the link below to activate your account<br>' . '<a href="' . base_url() . '/verify-account?email=' . $email . '&token=' . $token . '" target="_blank">Activate Now</a><br>This link will Expired before <strong>' . date('d F Y H:i:s', strtotime('+1 day', $startDate)) . ' Western Indonesia Time (WIB)</strong>.<br><br>Thanks.<br>Layanan Premium Team';
        } else if ($type == 'forgot-password') {
            $subject = "Reset your password Account Layanan Premium PLN DISJAYA";
            $message = 'Hi ' . $name . ', <br><br> Need to reset your password? No problem! Just click the link below and you\'ll be on your way. If you did not make this request, please ignore this email.<br>' . '<a href="' . base_url() . '/reset-password?email=' . $email . '&token=' . $token . '" target="_blank">Reset Password Now</a><br><br>This link will Expired before <strong>' . date('d F Y H:i:s', strtotime('+1 day', $startDate)) . ' Western Indonesia Time (WIB)</strong>.<br><br>Thanks.<br>Layanan Premium Team';
        }

        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('lpremium.pln@gmail.com', 'Administrator Layanan Premium');
        $email->setSubject($subject);
        $email->setMessage($message);


        if ($email->send()) {
            return true;
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
            die;
            // d($to);
        }
    }

    public function verify()
    {
        $session = session();

        $email = $this->request->getGet('email');
        $token = $this->request->getGet('token');

        $M_Auth = new M_Auth();
        $user = $M_Auth->where('email', $email)->first();

        $M_Token = new M_Token();
        if ($user) {
            $user_token = $M_Token->where('token', $token)->first();
            if ($user_token) {
                if (time() - strtotime($user_token['created_at']) < (60 * 60 * 24)) {
                    $M_Auth->where('email', $email)->set(['is_active' => 1])->update();
                    $M_Token->where('token', $token)->delete();
                    $session->setFlashdata('message', '<div class="alert alert-success" role="alert"><strong>' . $email . '</strong> has been Activated! Please login.</div>');
                    return redirect()->route('login');
                } else {
                    $M_Auth->where('email', $email)->delete();
                    $M_Token->where('token', $token)->delete();
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Account Activation <strong>Failed</strong>! Token Expired</div>');
                    return redirect()->route('login');
                }
            } else {
                $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Account Activation <strong>Failed</strong>! Invalid Token</div>');
                return redirect()->route('login');
            }
        } else {
            $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Account Activation <strong>Failed</strong>! Wrong Email</div>');
            return redirect()->to('login');
        }
    }

    public function forgotPassword()
    {
        $data = [];
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'valid_email' => 'Please enter a valid email address',
                    ]
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                $data['title'] = "Forgot Password";
                echo view('templates/auth_header', $data);
                echo view('auth/forgot-password');
                echo view('templates/auth_footer');
            } else {
                $M_Auth = new M_Auth();
                $M_Token = new M_Token();
                $email = $this->request->getPost('email');
                $users = $M_Auth->where('email', $email)->first();

                if ($users) {
                    $token = bin2hex(openssl_random_pseudo_bytes(32));
                    $user_token = [
                        'email' => $email,
                        'token' => $token,
                    ];
                    $name = $users['name'];

                    // Simpan token dan kirim email
                    $M_Token->save($user_token);
                    $this->_sendEmail($name, $email, $token, 'forgot-password');

                    $session->setFlashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset your password!</div>');
                    return redirect()->back();
                } else {
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Email is Not Registered!</div>');
                    return redirect()->back();
                }
                d($users);
            }
        } else {
            $data['title'] = "Forgot Password";
            echo view('templates/auth_header', $data);
            echo view('auth/forgot-password');
            echo view('templates/auth_footer');
        }
    }

    public function resetPassword()
    {
        $session = session();

        $email = $this->request->getGet('email');
        $token = $this->request->getGet('token');

        $M_Auth = new M_Auth();
        $M_Token = new M_Token();
        $user = $M_Auth->where('email', $email)->first();

        if ($user) {
            $user_token = $M_Token->where('token', $token)->first();
            if ($user_token) {
                if (time() - strtotime($user_token['created_at']) < (60 * 60 * 24)) {
                    $data = [
                        'reset_email' => $email,
                        'token_reset' => $user_token['token']
                    ];
                    $session->set($data);
                    $this->changePassword();
                } else {
                    $M_Token->where('token', $token)->delete();
                    $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Reset Password <strong>Failed</strong>! Token Expired</div>');
                    return redirect()->route('login');
                }
            } else {
                $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Reset Password <strong>Failed</strong>! Invalid Token</div>');
                return redirect()->to('login');
            }
        } else {
            $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Reset Password <strong>Failed</strong>! Wrong Email</div>');
            return redirect()->to('login');
        }
    }

    public function changePassword()
    {
        $session = session();
        $data['title'] = 'Recovery Password';

        if ($this->request->getMethod() === "put") {

            $email = $session->get('reset_email');
            $rules = [
                'password1' => [
                    'label' => 'New Password',
                    'rules' => "required|min_length[8]|regex_match[^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$]|sameOldPassword[$email]",
                    'errors' => [
                        'required' => 'New Password field is required',
                        'min_length'
                        => 'Password too short! Minimal 8 Characters',
                        'regex_match' => "Password must contain at least One Uppercase Letter, One Lowercase Letter and One Number",
                        'sameOldPassword' => "Please choose a password that you haven't used before!",

                    ]
                ],
                'password2' => [
                    'label' => 'Repeat Password',
                    'rules' => 'required|matches[password1]',
                    'errors' => [
                        'required' => 'Repeat Password is required',
                        'matches' => "Those password didn't match!",
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $new_password = $this->request->getPost('password1');
                $data = [
                    'password' => $new_password
                ];
                $M_Auth = new M_Auth();
                $M_Token = new M_Token();
                $M_Auth->where('email', $email)->set($data)->update();
                $M_Token->where('token', $session->get('token_reset'))->delete();
                unset($_SESSION['reset_email']);
                unset($_SESSION['token_email']);
                return redirect()->to('login')->with('message', '<div class="alert alert-success" role="alert">Your Password changed successfully. Please login</div>');
            }
        }
        echo view('templates/auth_header', $data);
        echo view('auth/change-password');
        echo view('templates/auth_footer');
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
