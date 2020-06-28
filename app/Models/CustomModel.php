<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class CustomModel
{
    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
    }

    public function getIdMenu($menu)
    {
        $builder = $this->db->table('user_menu');
        $id_menu = $builder->getWhere(['menu' => $menu])->getRowArray();
        return $id_menu;
    }

    public function getAccessMenu($id_role, $menu)
    {
        $queryMenu = $this->getIdMenu($menu);
        $id_menu = $queryMenu['id_user_menu'];

        $builder = $this->db->table('user_access_menu');
        $userAccess = $builder->getWhere(['id_role' => $id_role, 'id_user_menu' => $id_menu]);
        $userAccess = $builder->countAllResults();
        // return $userAccess;
        if ($userAccess < 1) {
            return false;
        } else {
            return true;
        }
    }

    public function getNotif($id_notification_target)
    {
        $builder = $this->db->table('notification_target');
        $builder->select('notification_target.id_notification_target,notification.title,notification.details,notification.created_at,user.name,customer.name_customer,customer.id_customer,type_notification.id_type_notification,type_notification.icon_notification,type_notification.bg_color');
        $builder->where('id_notification_target', $id_notification_target);
        $builder->join('notification', 'notification_target.id_notification = notification.id_notification');
        $builder->join('type_notification', 'notification.id_type_notification = type_notification.id_type_notification');
        $builder->join('customer', 'notification.id_customer = customer.id_customer');
        $builder->join('user', 'notification.id_user = user.id_user');
        return $builder->get()->getResultArray();
    }
}
