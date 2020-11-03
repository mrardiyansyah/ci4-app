<?php

namespace App\Models;

use CodeIgniter\Model;

class M_CancellationReport extends Model
{
    protected $table      = 'user_cancellation';
    protected $primaryKey = 'id_user_cancellation';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_salesman', 'id_customer', 'cancellation_reason', 'date_report'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}
