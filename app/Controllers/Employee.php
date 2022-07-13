<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\PayslipModel;


class Employee extends BaseController
{
    public function index()
    {
        return view('employee/dashboard');
    }

    //function to view the employee details page
	public function details()
	{

	}

	//function to view the employee's payslip
    public function payslip()
    {
        //1. Create an instance of the model
        $PayslipModel = new PayslipModel();

        //Temporary checkpoint
        echo "Model instance successfully created<br>";

        //2. Retrieve employee_id from session variable created in the Employee controller class
        $userDetails = $session->get('user_details');
        $employee_id = $userDetails['employee_id'];

        //3. Call model function
        $payslip = $PayslipModel->payslip($employee_id);

        //4. Check if the payslip has been computed
        if($payslip['is_computed'] == 1)
        {
            //display the payslip
            $session = session();
            $session->set('payslip', $payslip);

            //display payslip view

        }
        else
        {
            //payslip error message
            
        }
    }
}