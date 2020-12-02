<?php

namespace App\Models;

use CodeIgniter\Model;

class M_UserEnergize extends Model
{
    protected $table      = 'user_energize';
    protected $primaryKey = 'id_user_energize';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_user', 'id_customer', 'id_ba_aco', 'id_work_order', 'id_documentation',  'notes'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;


    public function getFileEnergize($id_customer)
    {
        $builder = $this->db->table($this->table);
        $builder->select('id_ba_aco, id_work_order, id_documentation');
        return $builder
            ->where('id_customer', $id_customer)
            ->get()
            ->getRowArray();
    }
}
