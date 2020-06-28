<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class UserFilter implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        if (!session()->has('isLoggedIn')) {
            $session = session();
            $session->setFlashdata('message', '<div class="alert alert-danger text-center" role="alert"><i class="fas fa-exclamation-circle"></i><strong> Please Login First!</strong></div>');
            return redirect()->to('login');
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do Something Here
    }
}
