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

    //function to retrieve employees and their gross salaries
    public function financialsList()
    {
        //Temporarily define $financialsList
        $financialsList = array();

        //Query
        $query = $this->db->query("
            SELECT employees.employee_ID, employees.firstname, employees.surname, `pay-slip`.gross_salary 
            FROM employees 
            INNER JOIN `pay-slip` ON employees.employee_ID=`pay-slip`.employee_ID
            WHERE employees.is_deleted = 0
            ");

        $i = 0;

        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize Financials List Array
        $financialsList[$i] = array('employee_id' => $row->employees.employee_ID, 'firstname' => $row->employees.firstname, 'surname' => $row->employees.surname, 'gross_salary' => $row->`pay-slip`.gross_salary);
        $i++;
        }

        //Return array
        return $financialsList;

    }

}