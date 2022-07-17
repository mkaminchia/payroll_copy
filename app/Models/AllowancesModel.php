<?php 

namespace App\Models;

use CodeIgniter\Model;

class AllowancesModel extends Model
{
	public function __construct()
    {
        //parent::__construct();
        //$this->db = \Config\Database::connect();
        $this->db = db_connect();
    }

    public function viewAllAllowances()
    {
        //Temporarily define $allowancesList
        $allowancesList = array();

        //Query
        $query = $this->db->query("
            SELECT allowance_ID, allowance_name
            FROM allowances 
            WHERE is_deleted = 0
            ");

        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize User Info Array
        $allowancesList = array('allowance_ID' => $row->allowance_ID, 'allowance_name' => $row->allowance_name);
        }

        //Return array
        return $allowancesList;
    }

    public function deleteAllowance($allowance_ID)
    {
        //Query
        if ($this->db->query("UPDATE allowances SET is_deleted = 1 WHERE allowance_ID = '$allowance_ID'"))
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

    public function addAllowance($allowance_name)
    {
        //Query
        //1. Insert into allowances table
        if ($this->db->query("INSERT INTO allowances (allowance_name) VALUES ('$allowance_name')"))
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

    public function allowanceFocus($allowance_ID)
    {
        //Temporarily define $allowanceDetails
        $allowanceDetails = array();

        //Query
        $query = $this->db->query("
            SELECT allowance_ID, allowance_name
            FROM allowances 
            WHERE allowance_ID = '$allowance_ID'
            ");

        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize allowanceDetails Array
        $allowanceDetails = array('allowance_ID' => $row->allowance_ID, 'allowance_name' => $row->allowance_name);
        }

        //Return array
        return $allowanceDetails;    
    }

    public function editAllowance($allowance_ID, $allowance_name)
    {
        //Query
        if ($this->db->query("UPDATE allowances SET allowance_name = '$allowance_name' WHERE allowance_ID = '$allowance_ID'"))
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