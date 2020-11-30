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

    public function getID($id_user, $id_customer)
    {
        $builder = $this->db->table($this->table);
        $builder->select('id_user_energize');
        return $builder->where('id_user', $id_user)
            ->where('id_customer', $id_customer)
            ->countAllResults();
    }

    public function getDirFileForConstruction($id_customer)
    {
        $builder = $this->db->table($this->table);
        $builder->select('id_reksis_sld, id_working_order');
        return $builder
            ->where('id_customer', $id_customer)
            ->get()
            ->getRowArray();
    }
}
