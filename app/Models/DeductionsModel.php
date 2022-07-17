<?php 

namespace App\Models;

use CodeIgniter\Model;

class DeductionsModel extends Model
{
	public function __construct()
    {
        //parent::__construct();
        //$this->db = \Config\Database::connect();
        $this->db = db_connect();
    }

    public function viewAllDeductions()
    {
        //Temporarily define $deductionsList
        $deductionsList = array();

        //Query
        $query = $this->db->query("
            SELECT deduction_id, deduction_name
            FROM deductions 
            WHERE is_deleted = 0
            ");

        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize User Info Array
        $deductionsList = array('deduction_id' => $row->deduction_id, 'deduction_name' => $row->deduction_name);
        }

        //Return array
        return $deductionsList;
    }

    public function deleteDeduction($deduction_id)
    {
        //Query
        if ($this->db->query("UPDATE deductions SET is_deleted = 1 WHERE deduction_id = '$deduction_id'"))
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

    public function addDeduction($deduction_name)
    {
        //Query
        //1. Insert into allowances table
        if ($this->db->query("INSERT INTO deductions (deduction_name) VALUES ('$deduction_name')"))
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

    public function deductionFocus($deduction_id)
    {
        //Temporarily define $deductionDetails
        $deductionDetails = array();

        //Query
        $query = $this->db->query("
            SELECT deduction_id, deduction_name
            FROM deductions 
            WHERE deduction_id = '$deduction_id'
            ");

        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize deductionDetails Array
        $deductionDetails = array('deduction_id' => $row->deduction_id, 'deduction_name' => $row->deduction_name);
        }

        //Return array
        return $deductionDetails;    
    }

    public function editDeduction($deduction_id, $deduction_name)
    {
        //Query
        if ($this->db->query("UPDATE deductions SET deduction_name = '$deduction_name' WHERE deduction_id = '$deduction_id'"))
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