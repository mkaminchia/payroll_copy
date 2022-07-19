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
		//Create model instance
		$viewProfileModel = new EmployeeModel();

		//Retrieve the admin's employee_id
		$session = session();
        $userDetails = $session->get('user_details');
        $employee_id = $userDetails['employee_id'];

		//Method function call
		$user_info = $viewProfileModel->selectOne($employee_id);
		
		//Create a session to store user info
        $session->set('user_details', $user_info);

		return view('admin/profile/viewprofile');
	}

	//function to delete your profile
	public function deleteProfile()
	{
		//Create an instance of the model
		$deleteEmployeeModel = new EmployeeModel();

		//Retrieve the admin's employee_id
		$session = session();
        $userDetails = $session->get('user_details');
        $employee_id = $userDetails['employee_id'];

		//Call model function
		$deleteEmployee = $deleteEmployeeModel->deleteEmployee($employee_id);

		//Redirect to login
		return redirect()->to('/');
	}

	//function to view the page to edit the admin's details (uses session data [user_details] from Login.php)
	public function editProfile()
	{
		//Create model instance
		$editProfileModel = new EmployeeModel();

		//Retrieve the admin's employee_id
		$session = session();
        $userDetails = $session->get('user_details');
        $employee_id = $userDetails['employee_id'];

		//Method function call
		$user_info = $editProfileModel->selectOne($employee_id);
		
		//Create a session to store user info
        $session->set('user_details', $user_info);
		
		return view('admin/profile/editprofile');
	}

	//function to process the edit made to the admin's personal details
	public function processEditProfile()
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
        	$firstname = $this->request->getPost('firstname');
        	$surname = $this->request->getPost('surname');
        	$email = $this->request->getPost('email');
            $age = $this->request->getPost('age');
            $phone_no = $this->request->getPost('phone_no');
        }

		//Send to model
		$confirmation = $editAdminModel->editEmployee($employee_id, $firstname, $surname, $email, $age, $phone_no);

		//If successful, redirect back to editAdminDetails

		//Test

		return redirect()->to('/admin/profile');
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
        	$age = $this->request->getPost('age');
            $phone_no = $this->request->getPost('phone_no');
            $password = $this->request->getPost('password');
        }

		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		//Call model function
		$registerEmployee = $registerEmployeeModel->registerEmployee($firstname, $surname, $role_id, $email, $age, $phone_no, $hashedPassword);

		//Redirect to loadEmployeesMenu
		return redirect()->to('/admin/employees');
	}

	//function to view the list of employees
	public function viewEmployeesPersonals()
	{
		//Create model instance
		$viewEmployeesModel = new EmployeeModel();

		//Call model function
		$employeesList = $viewEmployeesModel->viewAllEmployees();

		//Create a session to store a list of all employees
		$session = session();
        $session->set('employeesList', $employeesList);

		//View the page
		return view('admin/employees/viewemployeespersonals');
	}

	//function to load the confirm delete employee view
	public function confirmDeleteEmployee($employee_id){
		$data["employee_id"] = $employee_id;
		return view('admin/employees/confirmdeleteemployee', $data);
	}

	//function to delete a selected employee
	public function deleteEmployee($employee_id)
	{
		//Create an instance of the model
		$deleteEmployeeModel = new EmployeeModel();

		//Call model function
		$deleteEmployee = $deleteEmployeeModel->deleteEmployee($employee_id);

		//Redirect to viewEmployee
		return redirect()->to('/admin/employees/viewemployeespersonals');
	}

	//function to view the page to edit an employees personal details
	public function editEmployeePersonals($employee_id)
	{
		//Create an instance of the model
		$employeeFocusModel = new EmployeeModel();

		//Call model function to get current details
		$employee = $employeeFocusModel->employeeFocus($employee_id);

		//Create a session to store the details of the selected employee
		$session = session();
		$session->set('employee', $employee);

        //View Page
        return view('admin/employees/editemployeepersonals');
	}

	//function to process the edit of an employee's details
	public function processEditEmployeePersonals()
	{
		//Create an instance of the model
		$editEmployeeModel = new EmployeeModel();

		//Retrieve the employee_id of the selected employee
		$session = session();
        $employee_id = $_SESSION["employee"]["employee_id"];

		//Retrieve form data from editEmployee() page [Post]
		if($this->request->getMethod() === 'post')
        {
        	$firstname = $this->request->getPost('firstname');
        	$surname = $this->request->getPost('surname');
        	$email = $this->request->getPost('email');
        	$age = $this->request->getPost('age');
            $phone_no = $this->request->getPost('phone_no');
        }

		//Send to model
		$confirmation = $editEmployeeModel->editEmployee($employee_id, $firstname, $surname, $email, $age, $phone_no);

		//Redirect back to editEmployee
		return redirect()->to('/admin/employees/viewemployeespersonals');
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