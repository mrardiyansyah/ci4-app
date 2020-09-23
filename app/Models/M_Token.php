<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Token extends Model
{
    protected $table      = 'user_token';
    protected $primaryKey = 'id_user_token';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['token', 'email'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;


}
