<?php 

namespace App\Models;

use CodeIgniter\Model;

class EmployeeAllowancesModel extends Model
{
	public function __construct()
    {
        //parent::__construct();
        //$this->db = \Config\Database::connect();
        $this->db = db_connect();
    }

    public function viewAllEmployeeAllowances()
    {
        //Temporarily define $allowancesList
        $employeeAllowancesList = array();

        //Query
        $query = $this->db->query("
            SELECT detail_ID, employee_ID, allowance_ID, amount
            FROM `employee-allowance-details`
            WHERE is_deleted = 0
            ");

        $i = 0;
        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize User Info Array
        $employeeAllowancesList[$i] = array('detail_ID' => $row->detail_ID, 'employee_id' => $row->employee_ID, 'allowance_ID' => $row->allowance_ID, 'amount' => $row->amount);
        $i++;
        }

        //Return array
        return $employeeAllowancesList;
    }

    public function viewSpecificEmployeeAllowances($employee_id)
    {
        //Temporarily define $allowancesList
        $employeeSpecificAllowancesList = array();

        //Query
        $query = $this->db->query("
            SELECT detail_ID, employee_ID, allowance_ID, amount
            FROM `employee-allowance-details`
            WHERE is_deleted = 0 AND employee_ID = '$employee_id'
            ");

        $i = 0;
        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize User Info Array
        $employeeSpecificAllowancesList[$i] = array('detail_ID' => $row->detail_ID, 'employee_id' => $row->employee_ID, 'allowance_ID' => $row->allowance_ID, 'amount' => $row->amount);
        $i++;
        }

        //Return array
        return $employeeSpecificAllowancesList;
    }

    public function deleteEmployeeAllowance($detail_ID)
    {
        //Query
        if ($this->db->query("UPDATE `employee-allowance-details` SET is_deleted = 1 WHERE detail_ID = '$detail_ID'"))
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

    public function addEmployeeAllowance($employee_id, $allowance_ID, $amount)
    {
        //Query
        //1. Insert into employee-allowances-details table
        if ($this->db->query("INSERT INTO `employee-allowance-details` (employee_ID, allowance_ID, amount) VALUES ('$employee_id', '$allowance_ID', '$amount')"))
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

    public function employeeAllowanceFocus($detail_ID)
    {
        //Temporarily define $allowanceDetails
        $employeeAllowanceDetails = array();

        //Query
        $query = $this->db->query("
            SELECT detail_ID, employee_ID, allowance_ID, amount
            FROM `employee-allowance-details`
            WHERE detail_ID = '$detail_ID'
            ");

        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize allowanceDetails Array
        $employeeAllowanceDetails = array('detail_ID' => $row->detail_ID, 'employee_id' => $row->employee_ID, 'allowance_ID' => $row->allowance_ID, 'amount' => $row->amount);
        }

        //Return array
        return $employeeAllowanceDetails;    
    }

    public function editEmployeeAllowance($detail_ID, $allowance_ID, $amount)
    {
        //Query
        if ($this->db->query("UPDATE `employee-allowance-details` SET allowance_ID = '$allowance_ID', amount = '$amount' WHERE detail_ID = '$detail_ID'"))
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