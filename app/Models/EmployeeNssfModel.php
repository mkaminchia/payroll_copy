<?php 

namespace App\Models;

use CodeIgniter\Model;

class EmployeeNssfModel extends Model
{
	public function __construct()
    {
        //parent::__construct();
        //$this->db = \Config\Database::connect();
        $this->db = db_connect();
    }

    public function viewSpecificEmployeeNssf($employee_id)
    {
        //Temporarily define $benefitsList
        $employeeSpecificNssfList = array();

        //Query
        $query = $this->db->query("
            SELECT detail_ID, employee_ID, benefit_amount, relief_amount
            FROM `employee-nssf-details`
            WHERE is_deleted = 0 AND employee_ID = '$employee_id'
            ");

        $i = 0;
        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize User Info Array
        $employeeSpecificNssfList[$i] = array('detail_ID' => $row->detail_ID, 'employee_id' => $row->employee_ID, 'benefit_amount' => $row->benefit_amount, 'relief_amount' => $row->relief_amount);
        $i++;
        }

        //Return array
        return $employeeSpecificNssfList;
    }

}