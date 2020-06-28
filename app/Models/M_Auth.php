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
}
