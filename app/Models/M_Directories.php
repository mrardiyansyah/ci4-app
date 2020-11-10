<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Directories extends Model
{
    protected $table      = 'directories';
    protected $primaryKey = 'id_dir';

    // protected $returnType     = 'array';

    protected $allowedFields = ['dir_name', 'full_path'];

    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}
