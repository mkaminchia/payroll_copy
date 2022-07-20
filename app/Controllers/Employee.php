<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\PayslipModel;


class Employee extends BaseController
{
    public function index()
    {
        return view('employee/employeedashboard');
    }

    //function to view the employee details page
	public function profile()
	{
        //Create model instance
		$profileModel = new EmployeeModel();

		//Retrieve the employee_id
		$session = session();
        $userDetails = $session->get('user_details');
        $employee_id = $userDetails['employee_id'];

		//Method function call
		$user_info = $profileModel->selectOne($employee_id);
		
		//Create a session to store user info
        $session->set('user_details', $user_info);

        return view('employee/profile');
	}

	//function to view the employee's payslip
    public function payslip()
    {
        //1. Create an instance of the model
        $PayslipModel = new PayslipModel();

        //2. Retrieve employee_id from session variable created in the Employee controller class
        $session = session();
        $userDetails = $session->get('user_details');
        $employee_id = $userDetails['employee_id'];

        //3. Call model function
        $payslip = $PayslipModel->payslip($employee_id);

        if(!isset($payslip['is_computed'])){
            return view('employee/payslip');
        }

        //4. Check if the payslip has been computed
        if($payslip['is_computed'] == 1)
        {
            //display the payslip
            $session->set('payslip', $payslip);

            //display payslip view

        }
        else
        {
            return view('employee/payslip');
        }
    }

    //function to load page to change password
    public function changePassword()
    {
        //Create model instance
		$changePasswordModel = new EmployeeModel();

		//Retrieve the employee_id
		$session = session();
        $userDetails = $session->get('user_details');
        $employee_id = $userDetails['employee_id'];

        //Method function call
		$user_info = $changePasswordModel->selectOne($employee_id);
		$password = $changePasswordModel->getPassword($user_info["email"]);

		//Create a session to store user info
        $session->set('user_details', $user_info);

        $data["password"] = $password;

        return view('employee/changepassword', $data);
    }

    //function to process pasword change
    public function processChangePassword()
    {
        //Create model instance
        $changePasswordModel = new EmployeeModel();

        //Retrieve the employee_id
        $session = session();
        $userDetails = $session->get('user_details');
        $employee_id = $userDetails['employee_id'];

        //Method function call
		$user_info = $changePasswordModel->selectOne($employee_id);
		$password = $changePasswordModel->getPassword($user_info["email"]);

        //Retrieve form data from changePassword() page [Post]
		if($this->request->getMethod() === 'post')
        {
        	$old_password = $this->request->getPost('old_password');
        	$new_password = $this->request->getPost('new_password');
        	$confirm_password = $this->request->getPost('confirm_password');
        }

        if($new_password == $confirm_password)
        {
            if(password_verify($old_password, $password))
            {
                $hashedNewPassword = password_hash($new_password, PASSWORD_DEFAULT);

                $confirmation = $changePasswordModel->changePassword($employee_id, $hashedNewPassword);
                return redirect()->to('/employee');

            } else{
                return redirect()->to('/employee/changepassword')->with('status', 'The old password is incorrect');
            }
        } else{
            return redirect()->to('/employee/changepassword')->with('status', 'The new password should match the confirm password');
        }

        
        
    }
}