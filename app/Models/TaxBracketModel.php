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

}