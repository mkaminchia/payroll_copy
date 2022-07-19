<?php

namespace App\Controllers;

use App\Models\EmployeeModel;


class EmployeeFinancials extends BaseController
{
	//Function to display a list of employees with three buttone per row: view financial details, edit financial details, view payslip
	public function employeeFinancials()
	{
		//Create an instance of the model
		$employeeFinancialModel = new PayslipModel();

		//Retrieve the list of employees
		$financialsList = $employeeFinancialModel->financialsList();

		//Create session with list of employees and their gross salaries
		$session = session();
        $session->set('financialsList', $financialsList);

		//Display page
		//return view('');
	}

	//function to display the financial details of the selected employee
	public function employeeFinancialFocus()
	{
		//A. Retrieve employee_id from the employeeFinancials() view


		//Store in session variable


		//B. Retrieve gross_salary and totals for benefits, relief, deductions and allowances from payslip
		//1. Update totals


		//2. Retrieve data


		//C. Retrieve allowances details


		//D. Retrieve deductions details


		//E. Retrieve benefits details


		//F. Retrieve NHIF details


		//G. Retrieve NSSF details


		//H. Display the view
		//return view('');
	}

	//function to display the page to edit the financial info of a selected employee using 4 different forms: gross salary, normal benefits, allowances, deductions
	public function assignEmployeeFinancials()
	{
		//Retrieve employee_id from the employeeFinancials() page


		//Store in session variable


		//Retrieve list of all allowances to be used in dropdown menu


		//Retrieve list of all deductions to be used in dropdown menu


		//Retrieve list of all normal benefits to be used in dropdown menu


		//Display view
		//return view('');
	}

	//function to process the edit of gross salary
	public function editGrossSalary()
	{
		//Retrieve form data


		//Send to model function


		//Reditect to ?
		//return redirect()->to('');
	}

	//function to process the assignment of a benefit
	public function assignBenefit()
	{
		//Retrieve form data


		//Send to model function


		//Reditect to ?
		//return redirect()->to('');
	}

	//function to process the assignment of a deduction
	public function assignDeduction()
	{
		//Retrieve form data


		//Send to model function


		//Reditect to ?
		//return redirect()->to('');
	}

	//function to process the assignment of an allowance
	public function assignAllowance()
	{
		//Retrieve form data


		//Send to model function


		//Reditect to ?
		//return redirect()->to('');
	}

	//function to compute the paye of an employee from the button in the displayEmployeeFinancials() page
	public function computePaye()
	{

	}

	//public function to view an employee's payslip
	public function employeePayslip()
	{
		//Retrieve employee_id using GET

		//Call model function

		//If function to check if ready and redirect to page with either the payslip or an error message
	}


}