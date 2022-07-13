<?php 

namespace App\Models;

use CodeIgniter\Model;

class PayslipModel extends Model
{
	public function __construct()
    {
        //parent::__construct();
        //$this->db = \Config\Database::connect();
        $this->db = db_connect();
    }

    public function payslip($employee_id)
    {
        //Temporarily define $payslip
        $payslip = array();

        //Query
        $query = $this->db->query("
            SELECT *
            FROM `pay-slip` 
            WHERE employee_id = '$employee_id'
            ");

        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize User Info Array
        $payslip = array('is_computed' => $row->is_computed, 'gross_salary' => $row->gross_salary, 'paye' => $row->paye, 'net_salary' => $row->net_salary);
        }

        //Return array
        return $payslip;
    }

}