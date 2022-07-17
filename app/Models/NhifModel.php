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

}