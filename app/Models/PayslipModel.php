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
            WHERE employee_ID = '$employee_id'
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
        //Initialize $benefitsTotal
        $benefitsTotal = 0;

        //A. Retrieve NHIF relief value
        $query = $this->db->query("
            SELECT benefit_amount FROM `employee-nhif-details` WHERE employee_ID = '$employee_id'
            ");

        foreach ($query->getResult() as $row)
        {
            $benefitsTotal = $benefitsTotal + intval($row->benefit_amount);
        }

        //B. Retrieve NSSF relief value
        $query = $this->db->query("
            SELECT benefit_amount FROM `employee-nssf-details` WHERE employee_ID = '$employee_id'
            ");

        foreach ($query->getResult() as $row)
        {
            $benefitsTotal = $benefitsTotal + intval($row->benefit_amount);
        }

        //C. Retrieve normal Benefits' relief sum value
        $query = $this->db->query("
            SELECT SUM(benefit_amount) FROM `employee-benefit-details` WHERE employee_ID = '$employee_id'
            ");

        foreach ($query->getResult() as $row)
        {
            $benefitsTotal = $benefitsTotal + intval($row->benefit_amount);
        }

        //Insert into pay-slip table
        if($this->db->query("
            UPDATE `pay-slip`
            SET total_benefits = '$benefitsTotal'
            WHERE employee_ID = '$employee_id'
        "))
        {
            $confirmation = "Successful benefits update";
        }
        else
        {
            $confirmation = "Unsuccessful benefits update";
        }

        //Return
        return $confirmation;
    }

    //Function to calculate the total value of the relief allocated to an employee
    public function totalRelief($employee_id)
    {
        //Initialize $reliefTotal
        $reliefTotal = 0;

        //A. Retrieve NHIF relief value
        $query = $this->db->query("
            SELECT relief_amount FROM `employee-nhif-details` WHERE employee_ID = '$employee_id'
            ");

        foreach ($query->getResult() as $row)
        {
            $reliefTotal = $reliefTotal + intval($row->relief_amount);
        }

        //B. Retrieve NSSF relief value
        $query = $this->db->query("
            SELECT relief_amount FROM `employee-nssf-details` WHERE employee_ID = '$employee_id'
            ");

        foreach ($query->getResult() as $row)
        {
            $reliefTotal = $reliefTotal + intval($row->relief_amount);
        }

        //C. Retrieve normal Benefits' relief sum value
        $query = $this->db->query("
            SELECT SUM(relief_amount) FROM `employee-benefit-details` WHERE employee_ID = '$employee_id'
            ");

        foreach ($query->getResult() as $row)
        {
            $reliefTotal = $reliefTotal + intval($row->relief_amount);
        }

        //Insert into pay-slip table
        if($this->db->query("
            UPDATE `pay-slip`
            SET total_relief = '$reliefTotal'
            WHERE employee_ID = '$employee_id'
        "))
        {
            $confirmation = "Successful relief update";
        }
        else
        {
            $confirmation = "Unsuccessful relief update";
        }

        //Return
        return $confirmation;        
    }

    //Function to calculate the total value of allowances allocated to an employee
    public function totalAllowances($employee_id)
    {
        //Retrieve sum of allowances
        $query = $this->db->query("
            SELECT SUM(amount) FROM `employee-allowance-details` WHERE employee_ID = '$employee_id'
            ");

        foreach ($query->getResult() as $row)
        {
            $allowanceTotal = $row->amount;
        }

        //Insert into pay-slip table
        if($this->db->query("
            UPDATE `pay-slip`
            SET total_allowance = '$allowanceTotal'
            WHERE employee_ID = '$employee_id'
        "))
        {
            $confirmation = "Successful allowance update";
        }
        else
        {
            $confirmation = "Unsuccessful allowance update";
        }

        //Return
        return $confirmation;
    }

    //Function to calculate the total value of deductions allocated to an employee
    public function totalDeductions($employee_id)
    {
        //Retrieve sum of allowances
        $query = $this->db->query("
            SELECT SUM(amount) FROM `employee-deductions-details` WHERE employee_ID = '$employee_id'
            ");

        foreach ($query->getResult() as $row)
        {
            $deductionsTotal = $row->amount;
        }

        //Insert into pay-slip table
        if($this->db->query("
            UPDATE `pay-slip`
            SET total_deductions = '$deductionsTotal'
            WHERE employee_ID = '$employee_id'
        "))
        {
            $confirmation = "Successful deductions update";
        }
        else
        {
            $confirmation = "Unsuccessful deductions update";
        }

        //Return
        return $confirmation;
    }

    public function computeTaxableAndNet($employee_id)
    {
        //Retrieve employee's payslip
        //Query
        $query = $this->db->query("
            SELECT *
            FROM `pay-slip` 
            WHERE employee_ID = '$employee_id'
            ");

        //Store details in array
        foreach ($query->getResult() as $row)
        {
            //taxable income and net salary starting points
            $taxable_income = intval($row->gross_salary);
            $net_salary = intval($row->gross_salary);

            $total_allowance = intval($row->total_allowance);
            $total_deductons = intval($row->total_deductions);
            $total_benefits = intval($row->total_benefits);
            $total_relief = intval($row->total_relief);

            //taxable income
            $taxable_income = ($taxable_income - $total_relief + $total_allowance);

            //net salary
            $net_salary = ($net_salary - $total_deductions - $total_benefits + $total_allowance);
        }

        //Insert $taxable_income and $net_salary into payslip for the employee
        if($this->db->query("
            UPDATE `pay-slip`
            SET taxable_income = '$taxable_income', net_salary = '$net_salary'
            WHERE employee_ID = '$employee_id'
        "))
        {
            $confirmation = "Successful taxable income and net salary calculations";
        }
        else
        {
            $confirmation = "Unsuccessful taxable income and net salary calculations";
        }

        //Return
        return $confirmation;
    }
    
}