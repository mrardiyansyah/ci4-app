<?php

use App\Models\CustomModel;

function check_access_active($id_user_sub_menu)
{
    $db = db_connect();
    $builder = $db->table('user_sub_menu');
    $result = $builder->getWhere(['id_user_sub_menu' => $id_user_sub_menu])->getRowArray();
    $is_active = $result['is_active_menu'];

    if ($is_active > 0) {
        return "checked='checked'";
    }
}

function truncateText($text, $chars = 25)
{
    if (strlen($text) <= $chars) {
        return $text;
    }
    $text = $text . " ";
    $text = substr($text, 0, 19);
    // $text = substr($text, 0, strrpos($text, ' '));
    $text = $text . "..";
    return $text;
}

function change_format_time($timestamp)
{
    $timestamp = (string) $timestamp;
    $datetime = explode(' ', $timestamp);
    $date = explode('-', $datetime[0]);
    $time = explode(':', $datetime[1]);

    return $date + " " + $time;
}

function open_folder($name_customer, $timestamp)
{
    $rep = str_replace(':', '-', $timestamp);
    $folder = 'assets/report/' . $name_customer . '/' . $rep . '/';
    // $map = directory_map($folder);

    return $folder;
}

function open_folder_cancellation($name_customer)
{
    $folder = 'assets/berkas/' . $name_customer . '/Cancellation Folder' . '/';
    // $map = directory_map($folder);

    return $folder;
}

function get_new_notif()
{
    $session = session();
    $id_user = $session->get('id_user');

    $db = db_connect();
    $builder = $db->table('notification_target');
    $builder->select('notification_target.*,notification.created_at');
    $builder->join('notification', 'notification.id_notification = notification_target.id_notification');
    $builder->orderBy('created_at', 'DESC');
    // $ci->db->select('notification_target.*,notification.created_at');
    // $ci->db->join('notification', 'notification.id_notification = notification_target.id_notification');
    // $ci->db->order_by("created_at", "DESC");
    $query = $builder->getWhere(['id_target' => $id_user, 'status_read' => 0])->getResultArray();

    $notifications = array();
    $db = db_connect();
    $Model = new CustomModel($db);
    foreach ($query as $notif) {
        $notification = $Model->getNotif($notif['id_notification_target']);
        array_push($notifications, $notification);
    }
    return $notifications;
}

function count_notif($menu)
{
    $session = session();
    $db = db_connect();

    $builder = $db->table('notification_target');
    $builder->select('count(*) as t');
    $builder->join('notification', 'notification_target.id_notification = notification.id_notification');
    $builder->join('type_notification', 'notification.id_type_notification = type_notification.id_type_notification');
    $t = $builder->getWhere(['notification_target.id_target' => $session->get('id_user'), 'notification_target.status_read' => 0, 'type_notification.menu' => $menu])->getResultArray()[0];
    return ($t['t']);
}
