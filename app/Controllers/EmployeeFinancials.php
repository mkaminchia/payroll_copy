<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\BenefitsModel;
use App\Models\NhifModel;
use App\Models\NssfModel;
use App\Models\AllowancesModel;
use App\Models\DeductionsModel;


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
		if(isset($_GET['view']))
	    {
	        $employee_id = $_GET['view'];
	    }

		//Store in session variable
		$session = session();
		$session->set('employeeFinancialFocus', $employee_id);


		//B. Retrieve gross_salary and totals for benefits, relief, deductions and allowances from payslip
		//1. Update totals


		//2. Retrieve data from payslip


		//C. Retrieve allowances details


		//D. Retrieve deductions details


		//E. Retrieve benefits details


		//F. Retrieve NHIF details


		//G. Retrieve NSSF details


		//H. Display the view
		//return view('');
	}

	//Function to display the page to assign allowances, deductions, benefits and edit gross salary of a selected employee using 4 different forms: gross salary, normal benefits, allowances, deductions
	public function assignEmployeeFinancials()
	{
		//A. Retrieve employee_id from the employeeFinancials() page. In the forms, submit the employee_id as well
		if(isset($_GET['assign']))
	    {
	        $employee_id = $_GET['assign'];
	    }

		//Store in session variable
		$session = session();
		$session->set('employeeFinancialFocus', $employee_id);


		//B. Retrieve list of all allowances to be used in dropdown menu
		if(isset($_SESSION['allowancesList']))
		{
			//Retrieve array if session is already set
			$session = session();
        	$allowancesList = $session->get('allowancesList');
		}
		else
		{
			//Create an instance of the model
			$viewAllowancesModel = new AllowancesModel();

			//Call the model function
			$allowancesList = $viewAllowancesModel->viewAllAllowances();

			//Store all the retrieved allowances in a session variable
			$session = session();
	        $session->set('allowancesList', $allowancesList);
		}
		

		//C. Retrieve list of all deductions to be used in dropdown menu
		if(isset($_SESSION['deductionsList']))
		{
			//Retrieve array if session is already set
			$session = session();
        	$deductionsList = $session->get('deductionsList');
		}
		else
		{
			//Create an instance of the model
			$viewDeductionsModel = new DeductionsModel();

			//Call the model function
			$deductionsList = $viewDeductionsModel->viewAllDeductions();

			//Store all the retrieved deductions in a session variable
			$session = session();
	        $session->set('deductionsList', $deductionsList);
		}
		

		//D. Retrieve list of all normal benefits to be used in dropdown menu. In the view, don't display the rows with nhif and nssf.
		if(isset($_SESSION['benefitsList']))
		{
			//Retrieve array if session is already set
			$session = session();
        	$benefitsList = $session->get('benefitsList');
		}
		else
		{
			//Create an instance of the model
			$viewBenefitsModel = new BenefitsModel();

			//Call the model function
			$benefitsList = $viewBenefitsModel->viewAllBenefits();

			//Store all the retrieved benefits in a session variable
			$session = session();
	        $session->set('benefitsList', $benefitsList);
		}
		

		//E. Display view
		//return view('');
	}

	//function to process the edit of gross salary
	public function editGrossSalary()
	{
		//Retrieve form data


		//Send to model function to update gross salary in the pay-slip table


		//Model function to calculate NHIF values


		//Model function to calculate NSSF values


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