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
        if (!session()->has('isLoggedIn')) {
            $session = session();
            $session->setFlashdata('message', '<div class="alert alert-danger text-center" role="alert"><i class="fas fa-exclamation-circle"></i><strong> Please Login First!</strong></div>');
            return redirect()->to(site_url('login'));
        } else {
            $session = session();
            $id_role = $session->get('id_role');

            $uri = service('uri');
            $menu = $uri->getSegment(1);
            if ($menu == 'accountexecutive') {
                $menu = 'Account Executive';
            }
            $db = db_connect();
            $model = new CustomModel($db);
            $access = $model->getAccessMenu($id_role, $menu);
            // return print_r($access);
            if (!$access) {
                return redirect()->to('blocked');
            }
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)
    {
        // Do Something Here
    }
}
