<?php

namespace App\Models;

use CodeIgniter\Model;

class M_CancellationReport extends Model
{
    protected $table      = 'user_cancellation';
    protected $primaryKey = 'id_user_cancellation';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_user', 'id_customer', 'id_directories', 'id_approval_status', 'description', 'date_report', 'start_time', 'end_time', 'suggestion_solution', 'solutions'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getCancellationReport($id_user, $id_customer)
    {
        $builder = $this->db->table($this->table);
        $builder->select('user_cancellation.*, user.name, approval_status.*');
        return $builder
            ->where('user_cancellation.id_user', $id_user)
            ->where('id_customer', $id_customer)
            ->where('deleted_at', NULL)
            ->join('user', 'user_cancellation.id_user = user.id_user')
            ->join(
                'approval_status',
                'user_cancellation.id_approval_status = approval_status.id_approval_status'
            )
            ->get()
            ->getResultArray();
    }

    public function getCancellationReportByRole(string $role)
    {
        $builder = $this->db->table($this->table);
        $builder->select('user_cancellation.*, user.name, approval_status.*, user_role.*');
        return $builder
            ->where('user_cancellation.id_approval_status', 1)
            ->where('deleted_at', NULL)
            ->where('user_role.role_type', $role)
            ->orWhere('user_cancellation.id_approval_status', 4)
            ->join('user', 'user_cancellation.id_user = user.id_user')
            ->join('user_role', "user.id_role = user_role.id_role")
            ->join(
                'approval_status',
                'user_cancellation.id_approval_status = approval_status.id_approval_status'
            )
            ->get()
            ->getResultArray();
    }

    public function getReportLogById($id_user_cancellation)
    {
        $builder = $this->db->table($this->table);
        $builder->select('user_cancellation.*, user.name, customer.name_customer, approval_status.*, user_role.role_type, status.*');
        return $builder
            ->where('id_user_cancellation', $id_user_cancellation)
            ->join('user', 'user_cancellation.id_user = user.id_user')
            ->join('user_role', 'user.id_role = user_role.id_role')
            ->join('customer', 'user_cancellation.id_customer = customer.id_customer')
            ->join('status', 'customer.id_status = status.id_status')
            ->join('approval_status', 'user_cancellation.id_approval_status = approval_status.id_approval_status')
            ->get()
            ->getRowArray();
    }
}
