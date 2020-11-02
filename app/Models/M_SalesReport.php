<?php

namespace App\Models;

use CodeIgniter\Model;

class M_SalesReport extends Model
{
    protected $table      = 'user_report';
    protected $primaryKey = 'id_user_report';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_salesman', 'id_customer', 'discussed', 'date_report', 'start_time', 'end_time'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}
