<?php

namespace App\Models;

use CodeIgniter\Model;

class M_CompanyProfile extends Model
{
    protected $table      = 'company_profile';
    protected $primaryKey = 'id_company_profile';

    // protected $returnType     = 'array';

    protected $allowedFields = ['name_company', 'address_company', 'phone_company', 'facsimile', 'email_company', 'date_of_establishment'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

}
