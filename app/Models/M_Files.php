<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Files extends Model
{
    protected $table      = 'files';
    protected $primaryKey = 'id_file';

    // protected $returnType     = 'array';

    protected $allowedFields = ['id_dir', 'id_uploadedby', 'original_file_name', 'storage_file_name', 'size', 'mime_type', 'file_path', 'description'];

    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getInfoFileForConstruction($id_reksis_sld, $id_working_order)
    {
        $builder = $this->db->table($this->table);
        return $builder->select("$this->table.*,user.name")
            ->where('id_dir', $id_reksis_sld)
            ->orWhere('id_dir', $id_working_order)
            ->join('user', "$this->table.id_uploadedby = user.id_user")
            ->get()
            ->getResultArray();
    }

    public function getFileFromMultipleDirectories(array $id_directories)
    {
        $builder = $this->db->table($this->table);
        return $builder->select("$this->table.*,user.name")
            ->whereIn('id_dir', $id_directories)
            ->join('user', "$this->table.id_uploadedby = user.id_user")
            ->get()
            ->getResultArray();
    }

    public function getInfoFile($id_file)
    {
        $builder = $this->db->table($this->table);
        return $builder->select("$this->table.*,user.name")
            ->where('id_file', $id_file)
            ->join('user', "$this->table.id_uploadedby = user.id_user")
            ->get()
            ->getRowArray();
    }

    public function getAllInfoFileFromDirectories($id_dir)
    {
        $builder = $this->db->table($this->table);
        return $builder->select("$this->table.*,user.name")
            ->where('id_dir', $id_dir)
            ->join('user', "$this->table.id_uploadedby = user.id_user")
            ->get()
            ->getResultArray();
    }

    public function getFileEnergize($id_ba_aco, $id_working_order_energize)
    {
        $builder = $this->db->table($this->table);
        $id = [$id_ba_aco, $id_working_order_energize];
        return $builder->select("$this->table.*,user.name")
            ->whereIn('id_dir', $id)
            ->where('mime_type', 'application/pdf')
            ->join('user', "$this->table.id_uploadedby = user.id_user")
            ->get()
            ->getResultArray();
    }
}
