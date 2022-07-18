<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\RoleModel;

class Admin extends BaseController
{
	//function to view the admin dashboard
	public function index()
	{
		return view('admin/admindashboard');
	}



	//!!!ALL PROFILE FUNCTIONS

	//function to load the profile menu
	public function loadProfileMenu()
	{
		return view('admin/profile/profilemenu');
	}

	//function to view the admin's details page (uses session data [user_details] from Login.php)
	public function viewProfile()
	{
		return view('admin/profile/viewprofile');
	}

	//function to view the page to edit the admin's details (uses session data [user_details] from Login.php)
	public function editAdminDetails()
	{
		
	}

	//function to process the edit made to the admin's personal details
	public function processEditAdmin()
	{
		//Create model instance
		$editAdminModel = new EmployeeModel();

		//Retrieve the admin's employee_id
		$session = session();
        $userDetails = $session->get('user_details');
        $employee_id = $userDetails['employee_id'];

		//Retrieve form data from the editAdminDetails() page
		if($this->request->getMethod() === 'post')
        {
        	$email = $this->request->getPost('email');
            $phone_no = $this->request->getPost('phone_no');
        }

		//Send to model
		$confirmation = $editAdminModel->editEmployee($employee_id, $email, $phone_no);

		//If successful, redirect back to editAdminDetails

		//Test
		echo $confirmation;

		//return redirect()->to('');
	}




	
	//!!!ALL EMPLOYEE FUNCTIONS

	//function to load the employees menu
	public function loadEmployeesMenu()
	{
		return view('admin/employees/employeesmenu');
	}

	//function to display the page to register a new employee
	public function addEmployee()
	{
		//Create model instance
		$viewRolesModel = new RoleModel();

		//Call model function
		$rolesList = $viewRolesModel->viewAllRoles();

		//Create a session to store a list of all employees
		$session = session();
		$session->set('rolesList', $rolesList);

		return view('admin/employees/addemployee');
	}

	//function to process the registration of a new employee
	public function processAddEmployee()
	{
		//Create model instance
		$registerEmployeeModel = new EmployeeModel();

		//Retrieve form data from addEmployee() page [Post]
		if($this->request->getMethod() === 'post')
        {
			$firstname = $this->request->getPost('firstname');
        	$surname = $this->request->getPost('surname');
        	$role_id = $this->request->getPost('role_id');
        	$email = $this->request->getPost('email');
            $phone_no = $this->request->getPost('phone_no');
            $password = $this->request->getPost('password');
        }

		//Call model function
		$registerEmployee = $registerEmployeeModel->registerEmployee($firstname, $surname, $role_id, $email, $phone_no, $password);

		//Redirect to loadEmployeesMenu
		return redirect()->to('loadEmployeesMenu');
	}

	//function to view the list of employees
	public function viewEmployees()
	{
		//Create model instance
		$viewEmployeesModel = new EmployeeModel();

		//Call model function
		$employeeList = $viewEmployeesModel->viewAllEmployees();

		//Create a session to store a list of all employees
		$session = session();
        $session->set('employeeList', $employeeList);

		//View the page
		//return view('');
	}

	//function to delete a selected employee
	public function deleteEmployee()
	{
		//Create an instance of the model
		$deleteEmployeeModel = new EmployeeModel();

		//Retrieve selected employee from the viewEmployees() [Post]
		if(isset($_GET['delete']))
	    {
	        $employee_id = $_GET['delete'];
	    }

		//Call model function
		$deleteEmployee = $deleteEmployeeModel->deleteEmployee($employee_id);

		//Redirect to viewEmployee
		//return redirect()->to('');
	}

	//function to view the page to edit an employees personal details
	public function editEmployee()
	{
		//Create an instance of the model
		$employeeFocusModel = new EmployeeModel();

		//Case 1: Retrieve the selected employee from viewEmployees() [Post]
		if(isset($_GET['edit']))
	    {
	        $employee_id = $_GET['edit'];

	        //Call model function to get current details
			$editEmployeeDetails = $employeeFocusModel->employeeFocus($employee_id);

			//Create two sessions:
				//1. To store employee selected - editEmployee
				//2. To store the details of the selected employee - employeeDetails
			$session = session();
	        $session->set('editEmployee', $employee_id);
	        $session->set('editEmployeeDetails', $editEmployeeDetails);
	    }
	    //Case 2: Redirected after an employee's details are edited
	    else if(isset($_SESSION['editEmployee']))
	    {
	    	//Call model function to get updated details
			$editEmployeeDetails = $employeeFocusModel->employeeFocus($employee_id);

			//Create a session to store the details of the selected employee - employeeDetails
			$session = session();
	        $session->set('editEmployeeDetails', $editEmployeeDetails);
	    }

        //View Page
        //return view('');
	}

	//function to process the edit of an employee's details
	public function processEmployeeEdit()
	{
		//Create an instance of the model
		$editEmployeeModel = new EmployeeModel();

		//Retrieve the employee_id of the selected employee
		$session = session();
        $employee_id = $session->get('editEmployee');

		//Retrieve form data from editEmployee() page [Post]
		if($this->request->getMethod() === 'post')
        {
        	$email = $this->request->getPost('email');
            $phone_no = $this->request->getPost('phone_no');
        }

		//Send to model
		$confirmation = $editEmployeeModel->editEmployee($employee_id, $email, $phone_no);

		//Redirect back to editEmployee
		//return redirect()->to('');
	}	






	//!!!ALL FINANCIALS FUNCTIONS (Used to load menus, real functionality in System Financials Controller)

	//function to load the financials menu
	public function loadFinancialsMenu()
	{
		return view('admin/financials/financialsmenu');
	}	

	//function to load the benefits menu
	public function loadBenefitsMenu()
	{
		return view('admin/financials/benefits/benefitsmenu');
	}

	//function to load the allowances menu
	public function loadAllowancesMenu()
	{
		return view('admin/financials/allowances/allowancesmenu');
	}

	//function to load the deductions menu
	public function loadDeductionsMenu()
	{
		return view('admin/financials/deductions/deductionsmenu');
	}
	
}