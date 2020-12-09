<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\CustomModel;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = NULL)
    {
        $session = session();
        $id_role = $session->get('id_role');
        if (!session()->has('isLoggedIn')) {
            $session->setFlashdata('message', '<div class="alert alert-danger text-center" role="alert"><i class="fas fa-exclamation-circle"></i><strong> Please Login First!</strong></div>');
            return redirect()->to(site_url('login'));
        }

        if ($id_role == 1) {
            return;
        }

        if (empty($arguments)) {
            return;
        }
        // dd($arguments);
        foreach ($arguments as $id) {
            if ($id == $id_role) {
                return;
            }
        }

        return redirect()->route('blocked');
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)
    {
        // Do Something Here
    }
}
