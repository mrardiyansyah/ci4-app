<?php

namespace App\Models;

use CodeIgniter\Model;

class M_userAccess extends Model
{
    protected $table      = 'user_access_menu';
    protected $primaryKey = 'id_user_access_menu';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_role, id_user_menu'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

}
