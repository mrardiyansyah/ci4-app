<?php

namespace App\Models;

use CodeIgniter\Model;

class M_SubMenu extends Model
{
    protected $table      = 'user_sub_menu';
    protected $primaryKey = 'id_user_sub_menu';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_user_menu', 'title', 'url', 'icon', 'is_active_menu'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

}
