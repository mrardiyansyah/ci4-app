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

    public function getIdMenu(string $menu, $type)
    {
        if ($type == 'menu') {
            $builder = $this->db->table('user_menu');
            $builder->select('id_user_menu');
            $id_menu = $builder->getWhere(['menu' => $menu])->getRowArray();
            return $id_menu;
        } else if ($type == 'submenu') {
            $builder = $this->db->table('user_sub_menu');
            $builder->select('id_user_menu');
            $id_menu = $builder->like('url', $menu)->get()->getRowArray();
            // $id_menu = $builder->getWhere(['url' => $menu])->getRowArray();
            return $id_menu;
        }
    }

    public function getAccessMenu($id_role, string $menu, $type = 'menu')
    {

        $queryMenu = $this->getIdMenu($menu, $type);
        $id_menu = isset($queryMenu['id_user_menu']) ? $queryMenu['id_user_menu'] : 0;


        $builder = $this->db->table('user_access_menu');
        $userAccess = $builder->getWhere(['id_role' => $id_role, 'id_user_menu' => $id_menu])->getRowArray();

        // return $userAccess;
        if (is_null($userAccess)) {
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
}
