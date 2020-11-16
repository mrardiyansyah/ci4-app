<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Files extends Model
{
    protected $table      = 'files';
    protected $primaryKey = 'id_files';

    // protected $returnType     = 'array';

    protected $allowedFields = ['id_dir', 'id_uploadedby', 'original_file_name', 'storage_file_name', 'size', 'file_path', 'description'];

    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}
