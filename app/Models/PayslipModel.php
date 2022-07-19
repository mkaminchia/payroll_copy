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
        $payslip = array('is_computed' => $row->is_computed, 'gross_salary' => $row->gross_salary, 'total_allowance' => $row->total_allowance, 'total_deductions' => $row->total_deductions, 'total_benefits' => $row->total_benefits, 'total_relief' => $row->total_relief, 'paye' => $row->paye, 'net_salary' => $row->net_salary);
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
            SELECT employees.employee_ID AS employee_ID, employees.firstname AS firstname, employees.surname AS surname, `pay-slip`.gross_salary AS gross_salary 
            FROM employees 
            INNER JOIN `pay-slip` ON employees.employee_ID=`pay-slip`.employee_ID
            WHERE employees.is_deleted = 0 AND employees.role_id = 1
            ");

        $i = 0;

        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize Financials List Array
        $financialsList[$i] = array('employee_id' => $row->employee_ID, 'firstname' => $row->firstname, 'surname' => $row->surname, 'gross_salary' => $row->gross_salary);
        $i++;
        }

        //Return array
        return $financialsList;
    }

    //Function to calculate the total value of benefits allocated to an employee
    public function totalBenefits($employee_id)
    {
        //Retrieve NHIF benefit value

        //Retrieve NSSF benefit value

        //Retrieve normal Benefits sum value

        //Find sum of all 3

        //Insert into pay-slip table
    }

    //Function to calculate the total value of the relief allocated to an employee
    public function totalRelief($employee_id)
    {
        //Retrieve NHIF relief value

        //Retrieve NSSF relief value

        //Retrieve normal Benefits' relief sum value

        //Find sum of all 3

        //Insert into pay-slip table        
    }

    //Function to calculate the total value of allowances allocated to an employee
    public function totalAllowances($employee_id)
    {
        //Retrieve sum of allowances

        //Insert into pay-slip table
    }

    //Function to calculate the total value of deductions allocated to an employee
    public function totalDeductions($employee_id)
    {
        //Find sum of deductions

        //Insert into pay-slip table
    }


}