<?php 

namespace App\Models;

use CodeIgniter\Model;

class EmployeeNhifModel extends Model
{
	public function __construct()
    {
        //parent::__construct();
        //$this->db = \Config\Database::connect();
        $this->db = db_connect();
    }

    public function viewSpecificEmployeeNhif($employee_id)
    {
        //Temporarily define $benefitsList
        $employeeSpecificNhifList = array();

        //Query
        $query = $this->db->query("
            SELECT detail_ID, employee_ID, benefit_amount, relief_amount
            FROM `employee-nhif-details`
            WHERE is_deleted = 0 AND employee_ID = '$employee_id'
            ");

        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize User Info Array
        $employeeSpecificNhifList = array('detail_ID' => $row->detail_ID, 'employee_id' => $row->employee_ID, 'benefit_amount' => $row->benefit_amount, 'relief_amount' => $row->relief_amount);
        }

        //Return array
        return $employeeSpecificNhifList;
    }

}