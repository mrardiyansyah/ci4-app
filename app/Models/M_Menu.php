<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Menu extends Model
{
    protected $table      = 'user_menu';
    protected $primaryKey = 'id_user_menu';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['menu'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

}
