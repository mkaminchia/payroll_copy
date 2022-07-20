<?php 

namespace App\Models;

use CodeIgniter\Model;

class NssfModel extends Model
{
	public function __construct()
    {
        //parent::__construct();
        //$this->db = \Config\Database::connect();
        $this->db = db_connect();
    }

    public function nssfBrackets()
    {
        //Temporarily define $nssfBrackets
        $nssfBrackets = array();

        //Query
        $query = $this->db->query("
            SELECT bracket_ID, cut_off, amount
            FROM `nssf-brackets` 
            WHERE is_deleted = 0
            ");

        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize User Info Array
        $nssfBrackets = array('bracket_ID' => $row->bracket_ID, 'cut_off' => $row->cut_off, 'amount' => $row->amount);
        }

        //Return array
        return $nssfBrackets;
    }

    public function computeNssf($employee_id)
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

        //2. Retrieve relief_percentage from benefits table where benefit_name = nssf
        //Query
        $query = $this->db->query("
            SELECT relief_percentage
            FROM benefits 
            WHERE benefit_name = 'NSSF'
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
            FROM `nssf-brackets`
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
            UPDATE `employee-nssf-details`
            SET benefit_amount = '$benefit', relief_amount = '$relief'
            WHERE employee_ID = '$employee_id'
        "))
        {
            $confirmation = "Successful nssf calculations";
        }
        else
        {
            $confirmation = "Unsuccessful nssf calculations";
        }

        //Return
        return $confirmation;
    }
    
}
