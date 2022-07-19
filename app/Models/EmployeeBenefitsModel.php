<?php 

namespace App\Models;

use CodeIgniter\Model;

class EmployeeBenefitsModel extends Model
{
	public function __construct()
    {
        //parent::__construct();
        //$this->db = \Config\Database::connect();
        $this->db = db_connect();
    }

    public function viewAllEmployeeBenefits()
    {
        //Temporarily define $benefitsList
        $employeeBenefitsList = array();

        //Query
        $query = $this->db->query("
            SELECT detail_ID, employee_ID, benefit_ID, benefit_amount, relief_amount
            FROM `employee-benefit-details`
            WHERE is_deleted = 0
            ");

        $i = 0;
        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize User Info Array
        $employeeBenefitsList[$i] = array('detail_ID' => $row->detail_ID, 'employee_id' => $row->employee_ID, 'benefit_ID' => $row->benefit_ID, 'benefit_amount' => $row->benefit_amount, 'relief_amount' => $row->relief_amount);
        $i++;
        }

        //Return array
        return $employeeBenefitsList;
    }

    public function viewSpecificEmployeeBenefits($employee_id)
    {
        //Temporarily define $benefitsList
        $employeeSpecificBenefitsList = array();

        //Query
        $query = $this->db->query("
            SELECT detail_ID, employee_ID, benefit_ID, benefit_amount, relief_amount
            FROM `employee-benefit-details`
            WHERE is_deleted = 0 AND employee_ID = '$employee_id'
            ");

        $i = 0;
        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize User Info Array
        $employeeSpecificBenefitsList[$i] = array('detail_ID' => $row->detail_ID, 'employee_id' => $row->employee_ID, 'benefit_ID' => $row->benefit_ID, 'benefit_amount' => $row->benefit_amount, 'relief_amount' => $row->relief_amount);
        $i++;
        }

        //Return array
        return $employeeSpecificBenefitsList;
    }

    public function deleteEmployeeBenefit($detail_ID)
    {
        //Query
        if ($this->db->query("UPDATE `employee-benefit-details` SET is_deleted = 1 WHERE detail_ID = '$detail_ID'"))
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

    public function addEmployeeBenefit($employee_id, $benefit_ID, $benefit_amount, $relief_amount)
    {
        //Query
        //1. Insert into employee-benefits-details table
        if ($this->db->query("INSERT INTO `employee-benefit-details` (employee_ID, benefit_ID, benefit_amount, relief_amount) VALUES ('$employee_id', '$benefit_ID', '$benefit_amount', '$relief_amount')"))
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

    public function employeeBenefitFocus($detail_ID)
    {
        //Temporarily define $benefitDetails
        $employeeBenefitDetails = array();

        //Query
        $query = $this->db->query("
            SELECT detail_ID, employee_ID, benefit_ID, benefit_amount, relief_amount
            FROM `employee-benefit-details`
            WHERE detail_ID = '$detail_ID'
            ");

        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize benefitDetails Array
        $employeeBenefitDetails = array('detail_ID' => $row->detail_ID, 'employee_id' => $row->employee_ID, 'benefit_ID' => $row->benefit_ID, 'benefit_amount' => $row->benefit_amount, 'relief_amount' => $row->relief_amount);
        }

        //Return array
        return $employeeBenefitDetails;    
    }

    public function editEmployeeBenefit($detail_ID, $benefit_amount, $relief_amount)
    {
        //Query
        if ($this->db->query("UPDATE `employee-benefit-details` SET benefit_amount = '$benefit_amount', relief_amount = '$relief_amount' WHERE detail_ID = '$detail_ID'"))
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