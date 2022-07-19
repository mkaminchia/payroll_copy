<?php 

namespace App\Models;

use CodeIgniter\Model;

class EmployeeDeductionsModel extends Model
{
	public function __construct()
    {
        //parent::__construct();
        //$this->db = \Config\Database::connect();
        $this->db = db_connect();
    }

    public function viewAllEmployeeDeductions()
    {
        //Temporarily define $deductionsList
        $employeeDeductionsList = array();

        //Query
        $query = $this->db->query("
            SELECT detail_ID, employee_ID, deduction_id, amount
            FROM `employee-deduction-details`
            WHERE is_deleted = 0
            ");

        $i = 0;
        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize User Info Array
        $employeeDeductionsList[$i] = array('detail_ID' => $row->detail_ID, 'employee_id' => $row->employee_ID, 'deduction_id' => $row->deduction_id, 'amount' => $row->amount);
        $i++;
        }

        //Return array
        return $employeeDeductionsList;
    }

    public function viewSpecificEmployeeDeductions($employee_id)
    {
        //Temporarily define $deductionsList
        $employeeSpeificDeductionsList = array();

        //Query
        $query = $this->db->query("
            SELECT detail_ID, employee_ID, deduction_id, amount
            FROM `employee-deduction-details`
            WHERE is_deleted = 0 AND employee_ID = '$employee_id'
            ");

        $i = 0;
        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize User Info Array
        $employeeSpecificDeductionsList[$i] = array('detail_ID' => $row->detail_ID, 'employee_id' => $row->employee_ID, 'deduction_id' => $row->deduction_id, 'amount' => $row->amount);
        $i++;
        }

        //Return array
        return $employeeSpecificDeductionsList;
    }

    public function deleteEmployeeDeduction($detail_ID)
    {
        //Query
        if ($this->db->query("UPDATE `employee-deduction-details` SET is_deleted = 1 WHERE detail_ID = '$detail_ID'"))
        {
            $confirmation = "Successful";
        }
        else
        {
            $confirmation = "Unsuccessful";
        }

        //Return array
        return $confirmation;
    }

    public function addEmployeeDeduction($employee_id, $deduction_id, $amount)
    {
        //Query
        //1. Insert into employee-deductions-details table
        if ($this->db->query("INSERT INTO `employee-deduction-details` (employee_ID, deduction_id, amount) VALUES ('$employee_id', '$deduction_id', '$amount')"))
        {
            $confirmation = "Successful";           
        }
        else
        {
            $confirmation = "Unsuccessful";
        }

        //Return array
        return $confirmation;
    }

    public function employeeDeductionFocus($detail_ID)
    {
        //Temporarily define $deductionDetails
        $employeeDeductionDetails = array();

        //Query
        $query = $this->db->query("
            SELECT detail_ID, employee_ID, deduction_id, amount
            FROM `employee-deduction-details`
            WHERE detail_ID = '$detail_ID'
            ");

        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize deductionDetails Array
        $employeeDeductionDetails = array('detail_ID' => $row->detail_ID, 'employee_id' => $row->employee_ID, 'deduction_id' => $row->deduction_id, 'amount' => $row->amount);
        }

        //Return array
        return $employeeDeductionDetails;    
    }

    public function editEmployeeDeduction($detail_ID, $deduction_id, $amount)
    {
        //Query
        if ($this->db->query("UPDATE `employee-deduction-details` SET deduction_id = '$deduction_id', amount = '$amount' WHERE detail_ID = '$detail_ID'"))
        {
            $confirmation = "Successful";
        }
        else
        {
            $confirmation = "Unsuccessful";
        }

        //Return
        return $confirmation;
    }

}