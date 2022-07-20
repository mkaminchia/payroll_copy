<?php 

namespace App\Models;

use CodeIgniter\Model;

class TaxBracketModel extends Model
{
	public function __construct()
    {
        //parent::__construct();
        //$this->db = \Config\Database::connect();
        $this->db = db_connect();
    }

    public function viewTaxBrackets()
    {
        //Temporarily define $benefitsList
        $taxBrackets = array();

        //Query
        $query = $this->db->query("
            SELECT bracket_ID, cut_off, percentage
            FROM `tax-brackets`
            WHERE is_deleted = 0
            ");

        $i = 0;
        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize User Info Array
        $taxBrackets[$i] = array('bracket_ID' => $row->bracket_ID, 'cut_off' => $row->cut_off, 'percentage' => $row->percentage);
        $i++;
        }

        //Return array
        return $taxBrackets;
    }

    public function computePaye($employee_id)
    {
        //1. Initialize values for paye, taxable_income, percentage, prev_cut_off and current_cut_off
        $paye = 0;
        $prev_cut_off = 0;
        $current_cut_off = 0;
        $percentage = 0;

        //Retrieve taxable_income and net_salary from pay-slip
        //Query
        $query = $this->db->query("
            SELECT taxable_income, net_salary
            FROM `pay-slip` 
            WHERE employee_ID = '$employee_id'
            ");

        //Store details
        foreach ($query->getResult() as $row)
        {
            $taxable_income = intval($row->taxable_income);
            $net_salary = intval($row->net_salary);
        }

        //2. Retrieve tax bracket rows
        //Query
        $query = $this->db->query("
            SELECT *
            FROM `tax-brackets` 
            WHERE is_deleted = 0
            ");

        //Store details
        foreach ($query->getResult() as $row)
        {
        
            $current_cut_off = intval($row->cut_off);
            $percentage = intval($row->percentage);

            if( $taxable_income > $current_cut_off )
            {
                //paye for the tax bracket
                $paye = $paye + (($current_cut_off - $prev_cut_off) * $percentage);
                
                //update prev_cut_off
                $prev_cut_off = intval($row->current_cut_off);
            }
            elseif( $taxable_income <= $current_cut_off )
            {
                //paye for the tax bracket
                $paye = $paye + (($taxable_income - $prev_cut_off) * $percentage);
                
                //update prev_cut_off
                $prev_cut_off = intval($row->current_cut_off);
            }

        }

        //Case: taxable income is greater than the last cut_off amount
        if($taxable_income > $current_cut_off)
        {
            //paye for remaining amount
            $paye = $paye + (($taxable_income - $current_cut_off) * 25/100);
        }

        //Compute final net salary
        $net_salary = ($net_salary - $paye);

        //Input $paye and net_salary into the payslip for that employee
        if($this->db->query("
            UPDATE `pay-slip`
            SET paye = '$paye', net_salary = '$net_salary', is_computed = 1
            WHERE employee_ID = '$employee_id'
        "))
        {
            $confirmation = "Successful paye and final net salary calculations";
        }
        else
        {
            $confirmation = "Unsuccessful paye and final net salary calculations";
        }

    }
}