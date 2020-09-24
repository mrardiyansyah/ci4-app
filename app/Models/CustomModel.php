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

        $id_menu = isset($queryMenu['id_user_menu']) ? $queryMenu['id_user_menu'] : 0;

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

    public function getAllSubMenu()
    {
        $builder = $this->db->table('user_sub_menu');
        $builder->select('user_sub_menu.*, user_menu.menu');
        $builder->join('user_menu', 'user_sub_menu.id_user_menu = user_menu.id_user_menu');
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function getAllUser()
    {
        $builder = $this->db->table('user');
        $builder->select('user.*, user_role.role_type');
        $builder->join('user_role', 'user.id_role = user_role.id_role');
        $query = $builder->get()->getResultArray();
        return $query;
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
