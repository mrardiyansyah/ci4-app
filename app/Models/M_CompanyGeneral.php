<?php

namespace App\Models;

use CodeIgniter\Model;

class M_CompanyGeneral extends Model
{
    protected $table      = 'company_general';
    protected $primaryKey = 'id_company_general';

    // protected $returnType     = 'array';

    protected $allowedFields = ['name_company_general', 'position_company_general', 'phone_company_general', 'email_company_general'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

}
