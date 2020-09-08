<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Role extends Model
{
    protected $table      = 'user_role';
    protected $primaryKey = 'id_role';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['role_type'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function search($keyword)
    {
        return $this->table('user_role')->like('role_type', $keyword);
    }
}
