<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\M_Notification;

class Notification extends BaseController
{
    protected $M_Notification;

    public function __construct()
    {
        $this->M_Notification = new M_Notification();
    }

    public function read()
    {
        $session = session();
        if ($this->request->isAJAX()) {
            $id_notif = $this->request->getPost('id_notif');
            $notif = $this->M_Notification->getNotificationByID($id_notif);

            // Data for redirect
            $type = $notif['type'];
            $id_role = $session->get('id_role');
            $id_customer = $notif['id_customer'];
            $id_information = $notif['id_information'];

            try {
                // Update status read
                $status_read = $this->M_Notification->readNotification($notif['id_notification']);
            } catch (\Exception $e) {
                echo json_encode([
                    'error' => [
                        'message' => $e->getMessage(),
                        'code' => $e->getCode(),
                    ],
                ]);
            }

            switch ($type) {
                case 'Info':

                    if ($id_role == '3') {
                        echo json_encode([
                            'redirect' => true,
                            'redirect_url' => base_url('account-executive')
                        ]);
                    } elseif ($id_role == '4') {
                        echo json_encode([
                            'redirect' => true,
                            'redirect_url' => base_url('planning')
                        ]);
                    } elseif ($id_role == '5') {
                        echo json_encode([
                            'redirect' => true,
                            'redirect_url' => base_url('construction')
                        ]);
                    } elseif ($id_role == '19') {
                        echo json_encode([
                            'redirect' => true,
                            'redirect_url' => base_url('manager/konstruksi')
                        ]);
                    } elseif ($id_role == '20') {
                        echo json_encode([
                            'redirect' => true,
                            'redirect_url' => base_url('manager/pemasaran')
                        ]);
                    } else {
                        return false;
                    }
                    break;
                case 'Report':
                    if ($id_role == '19') {
                        echo json_encode([
                            'redirect' => true,
                            'redirect_url' => base_url('manager/konstruksi/detail/' . $id_customer)
                        ]);
                    } elseif ($id_role == '20') {
                        echo json_encode([
                            'redirect' => true,
                            'redirect_url' => base_url('manager/pemasaran/detail/' . $id_customer)
                        ]);
                    } else {
                        return false;
                    }
                    break;

                case 'Problem':
                    if ($id_role == '19') {
                        echo json_encode([
                            'redirect' => true,
                            'redirect_url' => base_url('manager/konstruksi/problem-report')
                        ]);
                    } elseif ($id_role == '20') {
                        echo json_encode([
                            'redirect' => true,
                            'redirect_url' => base_url('manager/pemasaran/problem-report')
                        ]);
                    } else {
                        return false;
                    }
                    break;
                case 'Request':
                    if ($id_information == '3') {
                        echo json_encode([
                            'redirect' => true,
                            'redirect_url' => base_url('planning/incoming-request')
                        ]);
                    } else if ($id_information == '7' && $session->get('id_role') == 19) {
                        echo json_encode([
                            'redirect' => true,
                            'redirect_url' => base_url('manager/konstruksi/detail/' . $id_customer)
                        ]);
                    } else if ($id_information == '7' && $session->get('id_role') == 5) {
                        echo json_encode([
                            'redirect' => true,
                            'redirect_url' => base_url('construction/detail/' . $id_customer)
                        ]);
                    } else {
                        return false;
                    }
                    break;

                default:
                    break;
            }
        }
    }
}
