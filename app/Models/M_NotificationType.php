<?php

namespace App\Models;

use CodeIgniter\Model;

class M_NotificationType extends Model
{
    protected $table      = 'notification_type';
    protected $primaryKey = 'id_notification_type';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_information, type, icon, bg_color'];

    // protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}
