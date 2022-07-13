<?php 

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
	public function __construct()
    {
        //parent::__construct();
        //$this->db = \Config\Database::connect();
        $this->db = db_connect();
    }

	public function login($email, $password)
	{
	
		//Temporarily define $user_info
		$user_info = array();

		//Query
		$query = $this->db->query("
			SELECT employee_ID, firstname, surname, role_id, email, phone_no, is_deleted
			FROM employees 
			WHERE email = '$email' AND password = '$password'
			");

		//Store details in array
		foreach ($query->getResult() as $row)
		{
		//Initialize User Info Array
		$user_info = array('employee_id' => $row->employee_ID, 'firstname' => $row->firstname, 'surname' => $row->surname, 'role_id' => $row->role_id, 'email' => $row->email, 'phone_no' => $row->phone_no, 'is_deleted' => $row->is_deleted);
		}

		//Return array
		return $user_info;
		

		//Model Test
		//return "Data Transfered to Model Successfully: Email - ".$email.", Password - ".$password; 
	}
}