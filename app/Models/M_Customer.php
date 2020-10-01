<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Customer extends Model
{
    protected $table      = 'customer';
    protected $primaryKey = 'id_customer';

    // protected $returnType     = 'array';

    protected $allowedFields = ['id_company_profile', 'id_company_leader', 'id_company_finance', 'id_company_engineering', 'id_company_general', 'name_customer', 'address_customer', 'id_tariff', 'power', 'subsistem', 'bep-value', 'id_substation', 'id_feeder_substation', 'id_type_of_service', 'id_status', 'id_information', 'id_salesman', 'captive_power', 'amount_of_power', 'next_meeting', 'suggestion', 'is_deleted', 'id_deletedby'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function countDataPerSalesman($id_salesman)
    {
        $builder = $this->db->table($this->table);
        $builder->select('id_user,name');
        return $builder->where('id_salesman', $id_salesman)->countAllResults();
    }
}
