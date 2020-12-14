<?php

namespace App\Libraries;

use App\Models\M_Notification;
use App\Models\M_NotificationType;

class Notification
{
    public function __construct()
    {
        $this->M_Notification = new M_Notification();
        $this->M_NotificationType = new M_NotificationType();
    }

    public function renderCounterNotif($id_user)
    {
        $data['notif'] = $this->M_Notification->getNotificationByUser($id_user);
        return view('components/counter_notif', $data);
    }

    public function renderListNotif($id_user)
    {
        $data['notif'] = $this->M_Notification->getNotificationByUser($id_user);
        return view('components/list_notif');
    }
}
