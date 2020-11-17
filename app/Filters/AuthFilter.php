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

            $db = db_connect();
            $model = new CustomModel($db);

            $id_role = $session->get('id_role');

            $uri = service('uri');

            $totalSegment = $uri->getTotalSegments();

            if ($totalSegment > 1) {
                $first_segment = $uri->getSegment(1);
                $condition = ['profile', 'planning', 'manager', 'construction'];
                if ($first_segment == 'account-executive') {
                    $menu = 'Account Executive';
                    $type = 'menu';
                } else if ($first_segment == 'admin') {
                    $menu = 'Administrator';
                    $type = 'menu';
                } else if (in_array($first_segment, $condition)) {
                    $menu = $first_segment;
                    $type = 'menu';
                } else {
                    $second_segment = $uri->getSegment(2);
                    $menu = "$first_segment/$second_segment";
                    $type = 'submenu';
                }
            } else {
                $menu = $uri->getSegment(1);
                if ($menu == 'account-executive') {
                    $menu = 'Account Executive';
                    $type = 'menu';
                } else if ($menu == 'profile') {
                    $type = 'menu';
                } else {
                    $type = 'submenu';
                }
            }
            $access = $model->getAccessMenu($id_role, $menu, $type);
            // return d($access);
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
