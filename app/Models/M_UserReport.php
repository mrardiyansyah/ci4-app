<?php

namespace App\Models;

use CodeIgniter\Model;

class M_UserReport extends Model
{
    protected $table      = 'user_report';
    protected $primaryKey = 'id_user_report';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_user', 'id_customer', 'id_directories', 'description', 'date_report', 'start_time',  'end_time', 'approval_status'];

    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getReportLog($id_user, $id_customer)
    {
        $builder = $this->db->table($this->table);
        $builder->select('user_report.*, user.name, approval_status.*');
        return $builder
            ->where('id_customer', $id_customer)
            ->where('deleted_at', NULL)
            ->join('user', 'user_report.id_user = user.id_user')
            ->join('approval_status', 'user_report.id_approval_status = approval_status.id_approval_status')
            ->get()
            ->getResultArray();
    }

    public function getReportLogById($id_user_report)
    {
        $builder = $this->db->table($this->table);
        $builder->select('user_report.*, user.name, customer.name_customer, approval_status.*');
        return $builder
            ->where('id_user_report', $id_user_report)
            ->join('user', 'user_report.id_user = user.id_user')
            ->join('customer', 'user_report.id_customer = customer.id_customer')
            ->join('approval_status', 'user_report.id_approval_status = approval_status.id_approval_status')
            ->get()
            ->getRowArray();
    }
}
