<?php 

namespace App\Models;

use CodeIgniter\Model;

class BenefitsModel extends Model
{
	public function __construct()
    {
        //parent::__construct();
        //$this->db = \Config\Database::connect();
        $this->db = db_connect();
    }

    public function viewAllBenefits()
    {
        //Temporarily define $benefitsList
        $benefitsList = array();

        //Query
        $query = $this->db->query("
            SELECT benefit_ID, benefit_name, relief_percentage
            FROM benefits 
            WHERE is_deleted = 0 AND benefit_name != 'NSSF' AND benefit_name != 'NHIF'
            ");

        $i = 0;
        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize User Info Array
        $benefitsList[$i] = array('benefit_ID' => $row->benefit_ID, 'benefit_name' => $row->benefit_name, 'relief_percentage' => $row->relief_percentage);
        $i++;
        }

        //Return array
        return $benefitsList;
    }

    public function deleteBenefit($benefit_ID)
    {
        //Query
        if ($this->db->query("UPDATE benefits SET is_deleted = 1 WHERE benefit_ID = '$benefit_ID'"))
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

    public function addBenefit($benefit_name, $relief_percentage)
    {
        //Query
        //1. Insert into benefits table
        if ($this->db->query("INSERT INTO benefits (benefit_name, relief_percentage) VALUES ('$benefit_name', '$relief_percentage')"))
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

    public function benefitFocus($benefit_ID)
    {
        //Temporarily define $benefitDetails
        $benefitDetails = array();

        //Query
        $query = $this->db->query("
            SELECT benefit_ID, benefit_name, relief_percentage
            FROM benefits 
            WHERE benefit_ID = '$benefit_ID'
            ");

        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize benefitDetails Array
        $benefitDetails = array('benefit_ID' => $row->benefit_ID, 'benefit_name' => $row->benefit_name, 'relief_percentage' => $row->relief_percentage);
        }

        //Return array
        return $benefitDetails;    
    }

    public function editBenefit($benefit_ID, $benefit_name, $relief_percentage)
    {
        //Query
        if ($this->db->query("UPDATE benefits SET benefit_name = '$benefit_name',  relief_percentage = '$relief_percentage' WHERE benefit_ID = '$benefit_ID'"))
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