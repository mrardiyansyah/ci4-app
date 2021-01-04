<?php

namespace App\Controllers\Planning;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\CustomerModel;
use App\Models\M_Customer;
use App\Models\M_Role;
use Exception;

class AddPotential extends BaseController
{
    protected $M_Auth, $M_Role, $M_Customer, $CustomerModel;

    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_Customer = new M_Customer();
        $db = db_connect();
        $this->CustomerModel = new CustomerModel($db);
    }

    public function index()
    {
        $session = session();
        $data['title'] = 'Add Data Potential';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));

        $data['customer'] = $this->CustomerModel->getCustomer();
        $data['service'] = $this->CustomerModel->getService();
        $data['substation'] = $this->CustomerModel->getSubstation();
        $data['feeder_substation'] = $this->CustomerModel->getFeederSubstation();
        $data['tariff'] = $this->CustomerModel->getTariff();

        if ($this->request->getMethod() == "put") {

            $rules = [
                'cust-name' => [
                    'label' => 'Customer Name',
                    'rules' => 'required'
                ],
                'cust-id' => [
                    'label' => 'ID Customer',
                    'rules' => 'required|max_length[9]|is_unique[customer.id_pelanggan]',
                    'errors' => [
                        'max_length' => 'ID Customer maximum length is 9',
                        'is_unique' => 'This ID Customer already exists in database'
                    ]
                ],
                'power' => [
                    'label' => 'Daya',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'numeric' => 'Numbers Only'
                    ]
                ],
                'tariff' => [
                    'label' => 'Tarif',
                    'rules' => 'required|max_length[2]',
                    'errors' => [
                        'max_length' => '3 Characters Only'
                    ]
                ],
                'cust-address' => [
                    'label' => 'Customer Address',
                    'rules' => 'required|min_length[10]'
                ],
                'substation' => [
                    'label' => 'Substation',
                    'rules' => 'required'
                ],
                'feeder-substation' => [
                    'label' => 'Feeder Substation',
                    'rules' => 'required'
                ],
                'subsistem' => [
                    'label' => 'Subsistem',
                    'rules' => 'required'
                ],
                'bep-value' => [
                    'label' => 'BEP Value',
                    'rules' => 'required'
                ],
                'recommend-service' => [
                    'label' => 'Service',
                    'rules' => 'required'
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $all_sales = $this->M_Auth->getAllSales();

                foreach ($all_sales as $key => $sales) {
                    $compare = $this->M_Customer->countDataPerSalesman($sales['id_user']);

                    $data_sales[] = [
                        'id_salesman' => $sales['id_user'],
                        'dataPerSales' => $compare
                    ];
                }

                // Sort value 'dataPerSales' by ASC
                usort($data_sales, function ($a, $b) {
                    return $a['dataPerSales'] <=> $b['dataPerSales'];
                });

                // Get ID user which 'dataPerSales' is the least
                $id_salesman = $data_sales[0]['id_salesman'];

                $data = [
                    'name_customer' => $this->request->getPost('cust-name'),
                    'id_pelanggan' => $this->request->getPost('cust-id'),
                    'id_tariff' => $this->request->getPost('tariff'),
                    'power' => $this->request->getPost('power'),
                    'address_customer' => $this->request->getPost('cust-address'),
                    'id_substation' => $this->request->getPost('substation'),
                    'id_feeder_substation' => $this->request->getPost('feeder-substation'),
                    'subsistem' => $this->request->getPost('subsistem'),
                    'bep_value' => $this->request->getPost('bep-value'),
                    'id_type_of_service' => $this->request->getPost('recommend-service'),
                    'id_status' => '1',
                    'id_information' => 1,
                    'id_salesman' => $id_salesman
                ];

                // dd($data);
                try {
                    $this->M_Customer->insert($data);
                } catch (\Exception $e) {
                    $session->setFlashdata('message', '<div class="alert alert-success" role="alert">
                        Data failed to add!</div>');
                    return redirect()->back();
                }

                $session->setFlashdata('message', '<div class="alert alert-success" role="alert">
                    Data successfully added!</div>');
                return redirect()->back();
            }
        }

        return view('planning/input_potential', $data);
    }

    public function importFile()
    {
        $session = session();
        $validation = \Config\Services::validation();

        // Get File Import
        $file = $this->request->getFile('file_excel');
        $data = [
            'file_excel' => $file,
        ];

        if ($validation->run($data, 'transaction') == FALSE) {
            $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">' . $validation->getError('file_excel') . '</div>');
            return redirect()->back();
        } else {

            // Ambil Tipe Extension dari File Excel
            $extension = $file->getClientExtension();

            // format excel 2007 ke bawah
            if ('xls' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                // format excel 2010 ke atas
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet = $reader->load($file);
            $cell = $spreadsheet->getActiveSheet()->toArray();


            // Data Salesman
            $all_sales = $this->M_Auth->getAllSales();

            foreach ($all_sales as $sales) {
                // Store ID User Salesman to variable id_salesman for input
                $id_salesman[] = $sales['id_user'];
            }


            // lewati baris ke 0 pada file excel
            // dalam kasus ini, array ke 0 adalah title
            $temp = 0;
            foreach ($cell as $idx => $row) {
                if ($idx == 0) {
                    continue;
                } else if (is_null($row[0])) {
                    // Kondisi dimana jika mengecek value didalam baris ada null maka berhenti
                    break;
                }

                // Get Nama Pelanggan
                $name_customer = $row[0];
                // Get ID Pel
                $id_pelanggan = $row[1];
                // Get Jenis Tarif
                (int)$tariff =  $this->CustomerModel->getIdByTariff($row[2]);
                // Get Daya
                $power = $row[3];
                // Get Alamat Pelanggan
                $address_customer = $row[4];
                // Get Gardu Induk (Substation)
                (int) $id_substation = $this->CustomerModel->getIdBySubstation($row[5]);
                // Get Gardu Penyulang (Feeder Substation)
                $id_feeder_substation = $this->CustomerModel->getIdByFeederSubstation($row[6]);
                // Get Subsistem
                $subsistem = $row[7];
                // Get Nilai Break Even Point (BEP Value)
                $bep_value = $row[8];
                // Get Rekomendasi Layanan (Service)
                (int) $service = $this->CustomerModel->getIdByService($row[9]);

                $data = [
                    'name_customer' => $name_customer ?? '',
                    'id_pelanggan' => $id_pelanggan ?? '',
                    'id_tariff' => $tariff['id_tariff'] ?? '',
                    'power' => $power,
                    'address_customer' => $address_customer ?? '',
                    'id_substation' => $id_substation['id_substation'] ?? '',
                    'id_feeder_substation' => $id_feeder_substation['id_feeder_substation'] ?? '',
                    'subsistem' => $subsistem ?? '',
                    'bep_value' => $bep_value ?? '',
                    'id_type_of_service' => $service['id_type_of_service'] ?? '',
                    'id_status' => 1,
                    'id_information' => 1,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ];

                $data['id_salesman'] = $id_salesman[$temp];
                $temp++;

                if ($temp % count($id_salesman) == 0) {
                    $temp = 0;
                }

                // Input Data Variable
                $input_data[] = $data;
            }
            // d($input_data);

            try {
                $insert = $this->M_Customer->insertBatch($input_data);
            } catch (Exception $e) {
                $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Failed to add Data. Please double check the data entered is correct and appropriate</div>');
                return redirect()->back();
            }

            if ($insert) {
                $session->setFlashdata('message', '<div class="alert alert-success" role="alert">
                    Data successfully added!</div>');
                return redirect()->back();
            } else {
                $session->setFlashdata('message', '<div class="alert alert-danger" role="alert">' . $this->M_Customer->errors() . '</div>');
                return redirect()->back();
            }
        }
    }
}
