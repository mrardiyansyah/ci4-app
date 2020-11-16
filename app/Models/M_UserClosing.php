<?php

namespace App\Models;

use CodeIgniter\Model;

class M_UserClosing extends Model
{
    protected $table      = 'user_closing';
    protected $primaryKey = 'id_user_closing';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_salesman', 'id_customer', 'id_app_letter', 'id_reksis_sld', 'id_spjbtl',  'id_working_order'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getID($id_salesman, $id_customer)
    {
        $builder = $this->db->table($this->table);
        $builder->select('id_user_closing');
        return $builder->where('id_salesman', $id_salesman)
            ->where('id_customer', $id_customer)
            ->countAllResults();
    }
}
