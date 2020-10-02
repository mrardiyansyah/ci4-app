<?php

namespace App\Models;

use CodeIgniter\Model;

class M_UserClosing extends Model
{
    protected $table      = 'user_closing';
    protected $primaryKey = 'id_user_closing';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_user', 'id_customer', 'id_user_app_leter', 'app_letter', 'id_user_reksis_sld', 'reksis_sld', 'id_user_spjbtl', 'spjbtl', 'id_user_contract_letter', 'contract_letter', 'id_user_wo_cons', 'working_order_cons'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;


}
