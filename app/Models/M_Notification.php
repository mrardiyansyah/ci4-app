<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\M_NotificationType;
use App\Models\CustomerModel;

class M_Notification extends Model
{
    protected $table      = 'notification';
    protected $primaryKey = 'id_notification';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;
    protected $allowedFields = ['id_customer', 'id_actor', 'id_target', 'id_notification_type', 'title', 'detail', 'status_read'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getNotificationByUser($id_target)
    {
        $builder = $this->db->table($this->table);
        $builder->select('notification.*, notification_type.type, notification_type.icon, notification_type.bg_color, user.name');
        return $builder
            ->where('notification.id_target', $id_target)
            ->where('notification.status_read', 0)
            ->join('notification_type', "notification_type.id_notification_type = notification.id_notification_type")
            ->join('customer', "notification.id_customer = customer.id_customer", 'left')
            ->join('user', 'notification.id_actor = user.id_user')
            ->orderBy('notification.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getNotificationByID($id_notification)
    {
        $builder = $this->db->table($this->table);
        $builder->select('notification.*, notification_type.id_information, notification_type.type, notification_type.icon, notification_type.bg_color, user.name, customer.name_customer, customer.id_status');
        return $builder
            ->where('notification.id_notification', $id_notification)
            ->join('notification_type', "notification_type.id_notification_type = notification.id_notification_type")
            ->join('user', 'notification.id_actor = user.id_user')
            ->orderBy('notification.created_at', 'DESC')
            ->join('customer', "notification.id_customer = customer.id_customer", 'left')
            ->get()
            ->getRowArray();
    }

    public function setNotification($id_customer, $id_actor, $id_target, string $title, string $detail, string $type): bool
    {
        $db = db_connect();
        $CustomerModel = new CustomerModel($db);
        $M_NotificationType = new M_NotificationType();

        $customer = $CustomerModel->getCustomerById($id_customer);
        $id_information = $customer['id_information'];

        $whereNotificationType = [
            'id_information' => $id_information,
            'type' => $type
        ];

        $notif_type = $M_NotificationType->where($whereNotificationType)->get()->getRowArray();

        $data_notif = [
            'id_customer' => $id_customer,
            'id_actor' => (int) $id_actor,
            'id_target' => $id_target,
            'id_notification_type' => $notif_type['id_notification_type'],
            'title' => $title,
            'detail' => $detail
        ];

        try {
            $insertNotif = $this->save($data_notif);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    public function readNotification($id_notification): bool
    {
        try {
            $this->update($id_notification, ['status_read' => 1]);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
}
