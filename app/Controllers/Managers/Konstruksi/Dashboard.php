<?php

namespace App\Controllers\Managers\Konstruksi;

use App\Controllers\BaseController;
use App\Models\M_Auth;
use App\Models\M_Customer;
use App\Models\CustomerModel;
use App\Models\M_Role;
use App\Models\M_UserReport;
use App\Models\M_CancellationReport;

class Dashboard extends BaseController
{
    protected $M_Auth, $M_Role, $M_Customer, $M_UserReport, $M_CancellationReport, $CustomerModel;


    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Role = new M_Role();
        $this->M_UserReport = new M_UserReport();
        $this->M_CancellationReport = new M_CancellationReport();
        $this->M_Customer = new M_Customer();
        $db = db_connect();
        $this->CustomerModel = new CustomerModel($db);
    }

    public function index()
    {
        $session = session();
        $data['title'] = 'Dashboard Construction';
        $data['user'] = $this->M_Auth->find($session->get('id_user'));
        $data['role'] =  $this->M_Role->find($session->get('id_role'));
        $role = 'Construction';

        // Total Customer
        $data['total_customer'] = $this->M_Customer->countAllResults();

        // Total Customer On Construction
        $data['total_construction'] = $this->M_Customer->where(['id_status' => 4])->countAllResults();

        // Total Customer Energizing / Finished
        $data['total_energize'] = $this->M_Customer->where(['id_status' => 5])->orWhere(['id_status' => 6])->countAllResults();

        // Total Customer Terminated
        $data['total_terminated'] = $this->M_Customer->where(['id_status' => 7])->countAllResults();

        // Data Customer
        $data['information'] = $this->CustomerModel->getAllCustomerForConstruction();

        // Data Work Order (Construction)
        $data['work_order'] = $this->CustomerModel->getInformationForWorkingOrder();

        // All Report Log
        $data['report_log'] = $this->M_UserReport->getReportByRole($role);

        // All Problem Report
        $problem = $this->M_CancellationReport->getCancellationReportByRole($role);
        $count_problem = 0;
        foreach ($problem as $p) {
            if ($p['id_approval_status'] == 1) {
                $count_problem++;
            } else {
                continue;
            }
        }
        $data['problem_report'] = $count_problem;
        // dd($problem);

        // List Supervisor Construction
        $data['list_spv'] = $this->M_Auth->getAllSupervisor();
        // d($data['list_spv']);

        return view('managers/konstruksi/dashboard', $data);
    }
}
