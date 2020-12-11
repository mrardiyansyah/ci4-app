<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Auth extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id_user';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'email', 'password', 'image', 'id_role', 'is_active'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    // protected function beforeInsert(array $data)
    // {
    //     $data = $this->hashPassword($data);
    //     return $data;
    // }

    // protected function beforeUpdate(array $data)
    // {
    //     $data = $this->hashPassword($data);
    //     return $data;
    // }

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password']))
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

        return $data;
    }

    public function getAllSales()
    {
        $builder = $this->db->table($this->table);
        $builder->select('id_user, name');
        return $builder->where('id_role', 3)->get()->getResultArray();
    }

    public function getAllSupervisor()
    {
        $builder = $this->db->table($this->table);
        $builder->select('user.id_user, user.name, user.image, user_role.*, customer.name_customer, customer.id_pengawas, status.*');
        return $builder
            ->where('user.id_role', 5)
            ->where('is_active', 1)
            ->join('user_role', "user.id_role = user_role.id_role")
            ->join('customer', "user.id_user = customer.id_pengawas", 'left')
            ->join('status', "customer.id_status = status.id_status", 'left')
            ->groupBy('user.id_user')
            ->orderBy('name_customer', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getAllAccountExecutive()
    {
        $builder = $this->db->table($this->table);
        $builder->select('user.id_user, user.name, user.image, user_role.*, count(customer.id_salesman) as total');
        return $builder
            ->where('user.id_role', 3)
            ->where('is_active', 1)
            ->join('user_role', "user.id_role = user_role.id_role")
            ->join('customer', "user.id_user = customer.id_salesman", 'left')
            ->groupBy('user.id_user')
            ->orderBy('total', 'ASC')
            ->get()
            ->getResultArray();
    }
}
