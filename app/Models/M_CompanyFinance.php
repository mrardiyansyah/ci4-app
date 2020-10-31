<?php

namespace App\Models;

use CodeIgniter\Model;

class M_CompanyFinance extends Model
{
    protected $table      = 'company_finance';
    protected $primaryKey = 'id_company_finance';

    // protected $returnType     = 'array';

    protected $allowedFields = ['name_company_finance', 'position', 'phone', 'email'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

}
