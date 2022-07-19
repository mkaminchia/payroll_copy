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
        //1. Initialize values for gross_salary, benefit, percentage, relief, relief_percentage, prev_cut_off and current_cut_off
        $gross_salary = 0;
        $benefit = 0;
        $percentage = 0;
        $relief = 0;
        $prev_cut_off = 0;
        $current_cut_off = 0;
        $relief_percentage = 0;

        //Retrieve gross_salary from payslip where employee_ID = employee_id
        //Query
        $query = $this->db->query("
            SELECT gross_salary
            FROM `pay-slip` 
            WHERE employee_ID = '$employee_id'
            ");

        //Store details in array
        foreach ($query->getResult() as $row)
        {
            $gross_salary = intval($row->gross_salary);
        }

        //Retrieve relief_percentage from benefits table where benefit_name = nssf
        //Query
        $query = $this->db->query("
            SELECT relief_percentage
            FROM benefits 
            WHERE benefit_name = 'nssf'
            ");

        //Store details in array
        foreach ($query->getResult() as $row)
        {
            $relief_percentage = intval($row->relief_percentage);
        }

        //2. Retrieve nssf bracket rows from nssf brackets table
        //Query
        $query = $this->db->query("
            SELECT *
            FROM `nssf-brackets` 
            WHERE is_deleted = 0
            ");

        //Store details in array
        foreach ($query->getResult() as $row)
        {
            $current_cut_off = intval($row->cut_off);
            $percentage = intval($row->percentage);

            if( $gross_salary > $current_cut_off )
            {
                //benefit for the nssf bracket
                $benefit = $benefit + (($current_cut_off - $prev_cut_off) * $percentage);
                
                //update prev_cut_off
                $prev_cut_off = intval($row->current_cut_off);
            }
            elseif( $gross_salary <= $current_cut_off )
            {
                //benefit for the nssf bracket
                $benefit = $benefit + (($gross_salary - $prev_cut_off) * $percentage);
                
                //update prev_cut_off
                $prev_cut_off = intval($row->current_cut_off);
            }

        }

        //Case: gross_salary is greater than the last cut_off amount
        if($gross_salary > $current_cut_off)
        {
            //benefit for remaining amount
            $benefit = $benefit + (($gross_salary - $current_cut_off) * $percentage);
        }

        //Calculate relief
        $relief = $benefit * $relief_percentage;

        //Input $benefit and $relief into the employee-nssf-details table for that employee
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
