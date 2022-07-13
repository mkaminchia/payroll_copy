<?php

namespace App\Controllers;

use App\Models\EmployeeModel;

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
		
	}
}