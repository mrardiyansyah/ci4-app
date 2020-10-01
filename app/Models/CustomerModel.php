<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class CustomerModel
{
    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
    }

    public function getCustomer()
    {
        $builder = $this->db->table('customer');
        $builder->select('*');
        return $builder
            ->where('deleted_at', null)
            ->join('service', 'customer.id_type_of_service = service.id_type_of_service')
            ->join('status', 'customer.id_status = status.id_status')
            ->join('tariff', 'customer.id_tariff = tariff.id_tariff')
            ->join('information', 'customer.id_information = information.id_information')
            ->orderBy('id_customer', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getCustomerById($id_customer)
    {
        $builder = $this->db->table('customer');
        $builder->select('*');
        return $builder
            ->where('id_customer', $id_customer)
            ->where('is_deleted !=', 1)
            ->join('service', 'customer.id_type_of_service = service.id_type_of_service')
            ->join('status', 'customer.id_status = status.id_status')
            ->join('tariff', 'customer.id_tariff = tariff.id_tariff')
            ->join('substation', 'customer.id_substation = substation.id_substation')
            ->join('feeder_substation', 'customer.id_feeder_substation = feeder_substation.id_feeder_substation')
            ->join('information', 'customer.id_information = information.id_information')
            ->get()
            ->getRowArray();
    }

    public function getService()
    {
        $builder = $this->db->table('service');
        $builder->select('*');
        return $builder->get()->getResultArray();
    }

    public function getSubstation()
    {
        $builder = $this->db->table('substation');
        $builder->select('*');
        return $builder->get()->getResultArray();
    }

    public function getFeederSubstation()
    {
        $builder = $this->db->table('feeder_substation');
        $builder->select('*');
        return $builder->get()->getResultArray();
    }

    public function getTariff()
    {
        $builder = $this->db->table('tariff');
        $builder->select('*');
        return $builder->get()->getResultArray();
    }

    public function getIdByTariff($tariff)
    {
        $builder = $this->db->table('tariff');
        $builder->select('id_tariff');
        return $builder->where('tariff', $tariff)->get()->getRowArray();
    }

    public function getIdBySubstation($substation)
    {
        $builder = $this->db->table('substation');
        $builder->select('id_substation');
        return $builder->where('name_substation', $substation)->get()->getRowArray();
    }

    public function getIdByFeederSubstation($feeder_substation)
    {
        $builder = $this->db->table('feeder_substation');
        $builder->select('id_feeder_substation');
        return $builder->where('name_feeder_substation', $feeder_substation)->get()->getRowArray();
    }

    public function getIdByService($service)
    {
        $builder = $this->db->table('service');
        $builder->select('id_type_of_service');
        return $builder->where('type_of_service', $service)->get()->getRowArray();
    }

    public function getInformationForReksis()
    {
        $builder = $this->db->table('customer');
        $builder->select('*');
        return $builder
            ->where('deleted_at', null) //WHERE CUSTOMER IS NOT DELETED
            ->where('customer.id_information', 3) // WHERE ID INFORMATION = 3 == INFORMATION = Menunggu Reksis
            ->orWhere('customer.id_information', 4) // WHERE ID INFORMATION = r == INFORMATION = Proses Reksis
            ->join('service', 'customer.id_type_of_service = service.id_type_of_service')
            ->join('status', 'customer.id_status = status.id_status')
            ->join('tariff', 'customer.id_tariff = tariff.id_tariff')
            ->join('substation', 'customer.id_substation = substation.id_substation')
            ->join('feeder_substation', 'customer.id_feeder_substation = feeder_substation.id_feeder_substation')
            ->join('information', 'customer.id_information = information.id_information')
            ->orderBy('id_customer', 'ASC')
            ->get()
            ->getResultArray();
    }
}
