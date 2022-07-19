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
			SELECT employee_ID, firstname, surname, role_id, email, age, phone_no, is_deleted
			FROM employees 
			WHERE email = '$email' AND password = '$password'
			");

		//Store details in array
		foreach ($query->getResult() as $row)
		{
		//Initialize User Info Array
		$user_info = array('employee_id' => $row->employee_ID, 'firstname' => $row->firstname, 'surname' => $row->surname, 'role_id' => $row->role_id, 'email' => $row->email, 'age' => $row->age, 'phone_no' => $row->phone_no, 'is_deleted' => $row->is_deleted);
		}

		//Return array
		return $user_info;
		

		//Model Test
		//return "Data Transfered to Model Successfully: Email - ".$email.", Password - ".$password; 
	}

	//This function selects an employee based on their employee id
	public function selectOne($employee_id)
	{
	
		//Temporarily define $user_info
		$user_info = array();

		//Query
		$query = $this->db->query("
			SELECT employee_ID, firstname, surname, role_id, email, age, phone_no, is_deleted
			FROM employees 
			WHERE employee_ID = '$employee_id'
			");

		//Store details in array
		foreach ($query->getResult() as $row)
		{
		//Initialize User Info Array
		$user_info = array('employee_id' => $row->employee_ID, 'firstname' => $row->firstname, 'surname' => $row->surname, 'role_id' => $row->role_id, 'email' => $row->email, 'age' => $row->age, 'phone_no' => $row->phone_no, 'is_deleted' => $row->is_deleted);
		}

		//Return array
		return $user_info;
		

		//Model Test
		//return "Data Transfered to Model Successfully: Email - ".$email.", Password - ".$password; 
	}

	public function editEmployee($employee_id, $firstname, $surname, $email, $age, $phone_no)
	{
		//Query
		if ($this->db->query("UPDATE employees SET firstname = '$firstname', surname = '$surname', email = '$email', age = '$age',  phone_no = '$phone_no' WHERE employee_ID = '$employee_id'"))
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

	public function viewAllEmployees()
	{
		//Temporarily define $employeesList
		$employeesList = array();

		//Query
		$query = $this->db->query("
			SELECT employee_ID, firstname, surname, email, age, phone_no
			FROM employees 
			WHERE is_deleted = 0 AND role_id = 1
			");

		$i = 0;
		//Store details in array
		foreach ($query->getResult() as $row)
		{
		//Initialize User Info Array
		$employeesList[$i] = array('employee_id' => $row->employee_ID, 'firstname' => $row->firstname, 'surname' => $row->surname, 'email' => $row->email, 'age' => $row->age, 'phone_no' => $row->phone_no);
		$i++;
		}

		//Return array
		return $employeesList;	
	}

	public function deleteEmployee($employee_id)
	{
		//Query
		if ($this->db->query("UPDATE employees SET is_deleted = 1 WHERE employee_id = '$employee_id'"))
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

	public function registerEmployee($firstname, $surname, $role_id, $email, $age, $phone_no, $password)
	{
		//Query
		//1. Insert into employees table
		if ($this->db->query("INSERT INTO employees (firstname, surname, role_id, email, age, phone_no, password) VALUES ('$firstname', '$surname', '$role_id', '$email', '$age', '$phone_no', '$password')"))
		{
			//2. Retrieve employee ID of newly added employee
	        $query = $this->db->query("
	        	SELECT * 
	        	FROM employees 
	        	ORDER BY employee_ID DESC 
	        	LIMIT 1
	        	");

	        foreach ($query->getResult() as $row)
			{
				//Test
				$employee_ID = $row->employee_ID;
				echo $employee_ID;

				if ($this->db->query("
					INSERT INTO `pay-slip` (employee_ID, gross_salary, total_allowance, total_deductions, total_benefits, total_relief, taxable_income, paye, net_salary) 
					VALUES ('$employee_ID', 0, 0, 0, 0, 0, 0, 0, 0)
					"))
				{
					$confirmation = "Successful";
				}
				else
				{
				    $confirmation = "Unsuccessful payslip insert query.";
				}
			}
		}
		else
		{
		    $confirmation = "Unsuccessful";
		}

		//Return array
		return $confirmation;

		//TEST
		//return "New user added: Name - $firstName $surname";
	}

	public function employeeFocus($employee_id)
	{
		//Temporarily define $user_info
		$employeeDetails = array();

		//Query
		$query = $this->db->query("
			SELECT employee_ID, firstname, surname, email, age, phone_no
			FROM employees 
			WHERE employee_id = '$employee_id'
			");

		//Store details in array
		foreach ($query->getResult() as $row)
		{
		//Initialize User Info Array
		$employeeDetails = array('employee_id' => $row->employee_ID, 'firstname' => $row->firstname, 'surname' => $row->surname, 'email' => $row->email, 'age' => $row->age, 'phone_no' => $row->phone_no);
		}

		//Return array
		return $employeeDetails;	
	}
}