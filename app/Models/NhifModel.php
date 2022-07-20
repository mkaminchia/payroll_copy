<?php 

namespace App\Models;

use CodeIgniter\Model;

class NhifModel extends Model
{
	public function __construct()
    {
        //parent::__construct();
        //$this->db = \Config\Database::connect();
        $this->db = db_connect();
    }

    public function nhifBrackets()
    {
        //Temporarily define $nhifBrackets
        $nhifBrackets = array();

        //Query
        $query = $this->db->query("
            SELECT bracket_ID, cut_off, amount
            FROM `nhif-brackets` 
            WHERE is_deleted = 0
            ");

        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize User Info Array
        $nhifBrackets = array('bracket_ID' => $row->bracket_ID, 'cut_off' => $row->cut_off, 'amount' => $row->amount);
        }

        //Return array
        return $nhifBrackets;
    }

    public function computeNhif($employee_id)
    {
        //1. Retrieve the gross_salary
        //Query
        $query = $this->db->query("
            SELECT gross_salary
            FROM `pay-slip` 
            WHERE employee_ID = '$employee_id'
            ");

        //Store details in array
        foreach ($query->getResult() as $row)
        {
            $gross_salary = $row->gross_salary;
        }

        //2. Retrieve relief_percentage from benefits table where benefit_name = nhif
        //Query
        $query = $this->db->query("
            SELECT relief_percentage
            FROM benefits 
            WHERE benefit_name = 'nhif'
            ");

        //Store details in array
        foreach ($query->getResult() as $row)
        {
            $relief_percentage = intval($row->relief_percentage);
        }

        //2. Identify the employee's bracket and retrieve the MPA
        //Query
        $query = $this->db->query("
            SELECT amount
            FROM `pay-slip`
            WHERE cut_off <= '$gross_salary'
            ORDER BY cut_off DESC
            LIMIT 1;
            ");

        //Store details in array
        foreach ($query->getResult() as $row)
        {
            $benefit = $row->amount;
        }

        //Calculate relief
        $relief = ($benefit * ($relief_percentage/100));

        //Input $benefit and $relief into the employee-nhif-details table for that employee
        if($this->db->query("
            UPDATE `employee-nhif-details`
            SET benefit_amount = '$benefit', relief_amount = '$relief'
            WHERE employee_ID = '$employee_id'
        "))
        {
            $confirmation = "Successful nhif calculations";
        }
        else
        {
            $confirmation = "Unsuccessful nhif calculations";
        }

        //Return
        return $confirmation;
    }

}