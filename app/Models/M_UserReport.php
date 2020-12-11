<?php

namespace App\Models;

use CodeIgniter\Model;

class M_UserReport extends Model
{
    protected $table      = 'user_report';
    protected $primaryKey = 'id_user_report';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_user', 'id_customer', 'id_manager', 'id_directories', 'description', 'date_report', 'start_time',  'end_time', 'id_approval_status'];

    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getReportByRole(string $role)
    {
        $builder = $this->db->table($this->table);
        $builder->select('user_report.*, user.name, user_role.*, approval_status.*, customer.name_customer');
        return $builder
            ->where('user_role.role_type', $role)
            ->where('user_report.id_approval_status', 1)
            ->where('user_report.deleted_at', NULL)
            ->join('user', 'user_report.id_user = user.id_user')
            ->join('user_role', "user.id_role = user_role.id_role")
            ->join('approval_status', 'user_report.id_approval_status = approval_status.id_approval_status')
            ->join('customer', 'user_report.id_customer = customer.id_customer', 'left')
            ->get()
            ->getResultArray();
    }

    public function getReportByRolePerCustomer(string $role, $id_customer)
    {
        $builder = $this->db->table($this->table);
        $builder->select('user_report.*, user.name, approval_status.*, user_role.*');
        return $builder
            ->where('user_role.role_type', $role)
            ->where('id_customer', $id_customer)
            ->where('deleted_at', NULL)
            ->join('user', 'user_report.id_user = user.id_user')
            ->join('user_role', "user.id_role = user_role.id_role")
            ->join('approval_status', 'user_report.id_approval_status = approval_status.id_approval_status')
            ->get()
            ->getResultArray();
    }

    public function getReportPerCustomer($id_customer)
    {
        $builder = $this->db->table($this->table);
        $builder->select('user_report.*, user.name, approval_status.*, user_role.*');
        return $builder
            ->where('id_customer', $id_customer)
            ->where('deleted_at', NULL)
            ->join('user', 'user_report.id_user = user.id_user')
            ->join('user_role', "user.id_role = user_role.id_role")
            ->join('approval_status', 'user_report.id_approval_status = approval_status.id_approval_status')
            ->get()
            ->getResultArray();
    }

    public function getReportLogById($id_user_report)
    {
        $builder = $this->db->table($this->table);
        $builder->select('user_report.*, user.name, customer.name_customer, approval_status.*, user_role.*');
        return $builder
            ->where('id_user_report', $id_user_report)
            ->join('user', 'user_report.id_user = user.id_user')
            ->join('customer', 'user_report.id_customer = customer.id_customer')
            ->join('user_role', "user.id_role = user_role.id_role")
            ->join('approval_status', 'user_report.id_approval_status = approval_status.id_approval_status')
            ->get()
            ->getRowArray();
    }
}
