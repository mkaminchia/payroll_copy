<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\BenefitsModel;
use App\Models\NhifModel;
use App\Models\NssfModel;
use App\Models\AllowancesModel;
use App\Models\DeductionsModel;
use App\Models\EmployeeBenefitsModel;
use App\Models\EmployeeAllowancesModel;
use App\Models\EmployeeDeductionsModel;
use App\Models\EmployeeNhifModel;
use App\Models\EmployeeNssfModel;
use App\Models\TaxBracketModel;
use App\Models\PayslipModel;

class EmployeeFinancials extends BaseController
{
	//Function to display a list of employees with three buttone per row: view financial details, edit financial details, view payslip
	public function viewEmployeesFinancials()
	{
		//Create an instance of the model
		$employeeFinancialModel = new PayslipModel();

		//Retrieve the list of employees
		$financialsList = $employeeFinancialModel->financialsList();

		//Create session with list of employees and their gross salaries
		$session = session();
        $session->set('financialsList', $financialsList);

		//Display page
		return view('admin/employees/viewemployeesfinancials');
	}

	//function to load the assignments menu
	public function loadAssignmentsMenu($employee_id)
	{
		$data["employee_id"] = $employee_id;
		return view('admin/employees/assignmentsmenu', $data);
	}

	//function to load the edits menu
	public function loadEditsMenu($employee_id)
	{
		$data["employee_id"] = $employee_id;
		return view('admin/employees/editsmenu', $data);
	}

	//function to load the page to assign a benefit
	public function assignBenefit($employee_id)
	{
		//Retrieve the employee id
		$data["employee_id"] = $employee_id;

		//Create an instance of the model
		$assignBenefitModel = new BenefitsModel();

		//Retrieve the list of benefits
		$benefitsList = $assignBenefitModel->viewAllBenefits();

		//Create session with list of benefits
		$session = session();
        $session->set('benefitsList', $benefitsList);

		//Display page
		return view('admin/employees/assignbenefit', $data);
	}

	//function to process the assignment of a benefit
	public function processAssignBenefit($employee_id)
	{
		//Create an instance of the model
		$processAssignBenefitModel = new EmployeeBenefitsModel();

		//Retrieve form data from assignBenefit() page [Post]
		if($this->request->getMethod() === 'post')
        {
        	$benefit_ID = $this->request->getPost('benefit_ID');
        	$benefit_amount = $this->request->getPost('benefit_amount');
        }

		//Calculation of relief amount
		//Create an instance of the model
		$reliefPercentageModel = new BenefitsModel();
		//Retrieve relief percentage for the specific benefit
		$benefit = $reliefPercentageModel->benefitFocus($benefit_ID);
		$relief_percentage = $benefit["relief_percentage"];
		//Calculate relief amount
		$relief_amount = $benefit_amount * ($relief_percentage/100);

		//Send to model
		$confirmation = $processAssignBenefitModel->addEmployeeBenefit($employee_id, $benefit_ID, $benefit_amount, $relief_amount);

		//Redirect back to loadAssignmentsMenu()
		return redirect()->to('/admin/employees/assignmentsmenu/'.$employee_id);
	}

	//function to load the page to assign an allowance
	public function assignAllowance($employee_id)
	{
		//Retrieve the employee id
		$data["employee_id"] = $employee_id;

		//Create an instance of the model
		$assignAllowanceModel = new AllowancesModel();

		//Retrieve the list of allowances
		$allowancesList = $assignAllowanceModel->viewAllAllowances();

		//Create session with list of allowances
		$session = session();
        $session->set('allowancesList', $allowancesList);

		//Display page
		return view('admin/employees/assignallowance', $data);
	}

	//function to process the assignment of an allowance
	public function processAssignAllowance($employee_id)
	{
		//Create an instance of the model
		$processAssignAllowanceModel = new EmployeeAllowancesModel();

		//Retrieve form data from assignAllowance() page [Post]
		if($this->request->getMethod() === 'post')
        {
        	$allowance_ID = $this->request->getPost('allowance_ID');
        	$amount = $this->request->getPost('amount');
        }

		//Send to model
		$confirmation = $processAssignAllowanceModel->addEmployeeAllowance($employee_id, $allowance_ID, $amount);

		//Redirect back to loadAssignmentsMenu()
		return redirect()->to('/admin/employees/assignmentsmenu/'.$employee_id);
	}

	//function to load the page to assign a deduction
	public function assignDeduction($employee_id)
	{
		//Retrieve the employee id
		$data["employee_id"] = $employee_id;

		//Create an instance of the model
		$assignDeductionModel = new DeductionsModel();

		//Retrieve the list of deductions
		$deductionsList = $assignDeductionModel->viewAllDeductions();

		//Create session with list of deductions
		$session = session();
        $session->set('deductionsList', $deductionsList);

		//Display page
		return view('admin/employees/assigndeduction', $data);
	}

	//function to process the assignment of a deduction
	public function processAssignDeduction($employee_id)
	{
		//Create an instance of the model
		$processAssignDeductionModel = new EmployeeDeductionsModel();

		//Retrieve form data from assignDeduction() page [Post]
		if($this->request->getMethod() === 'post')
        {
        	$deduction_id = $this->request->getPost('deduction_id');
        	$amount = $this->request->getPost('amount');
        }

		//Send to model
		$confirmation = $processAssignDeductionModel->addEmployeeDeduction($employee_id, $deduction_id, $amount);

		//Redirect back to loadAssignmentsMenu()
		return redirect()->to('/admin/employees/assignmentsmenu/'.$employee_id);
	}

	//function to load the page to edit gross salary
	public function editGrossSalary($employee_id)
	{
		//Create an instance of the model
		$editGrossSalaryModel = new PayslipModel();

		//Retrieve the list of employees
		$grossSalary = $editGrossSalaryModel->payslip($employee_id);

		//Create session with list of employees and their gross salaries
		$session = session();
		$session->set('grossSalary', $grossSalary);

		//Display page
		return view('admin/employees/editgrosssalary');
	}

	//function to process the edit of gross salary
	public function processEditGrossSalary($employee_id)
	{
		//Create an instance of the model
		$processEditGrossSalary = new PayslipModel();

		//Retrieve form data from assignAllowance() page [Post]
		if($this->request->getMethod() === 'post')
        {
        	$gross_salary = $this->request->getPost('gross_salary');
        }

		//Send to model
		$confirmation = $processEditGrossSalary->editGrossSalary($employee_id, $gross_salary);

		//B. Model function to calculate NHIF values
		//Model instance
		$calculateNhifModel = new NhifModel();

		//Model function call
		$confirmation = $calculateNhifModel->computeNhif($employee_id);

		//C. Model function to calculate NSSF values
		//Model instance
		$calculateNssfModel = new NssfModel();

		//Model function call
		$confirmation = $calculateNssfModel->computeNssf($employee_id);

		//Redirect back to loadAssignmentsMenu()
		return redirect()->to('/admin/employees/editsmenu/'.$employee_id);
	}

	//function to load the page with all benefits assigned to employee
	public function viewAssignedBenefits($employee_id)
	{
		//Retrieve the employee id
		$data["employee_id"] = $employee_id;

		//Create an instance of the models
		$allBenefitsModel = new BenefitsModel();
		$allEmployeesModel = new EmployeeModel();
		$viewAssignedBenefitModel = new EmployeeBenefitsModel();

		//Retrieve all benefits
		$benefitsList = $allBenefitsModel->viewAllBenefits();

		//Retrieve all employees
		$employeesList = $allEmployeesModel->viewAllEmployees();

		//Create session with list of benefits
		$session = session();
        $session->set('benefitsList', $benefitsList);

		//Create a session with list of employees
        $session->set('employeesList', $employeesList);

		//Retrieve the list of benefits for the employee
		$employeeBenefitsList = $viewAssignedBenefitModel->viewSpecificEmployeeBenefits($employee_id);

		//Create session with list of benefits for the employee
        $session->set('employeeBenefitsList', $employeeBenefitsList);

		//Display page
		return view('admin/employees/viewassignedbenefits', $data);
	}

	//function to load the page to edit an assigned benefit
	public function editAssignedBenefit($detail_ID)
	{
		//Create an instance of the models
		$allBenefitsModel = new BenefitsModel();
		$editAssignedBenefitModel = new EmployeeBenefitsModel();

		//Retrieve all benefits
		$benefitsList = $allBenefitsModel->viewAllBenefits();

		//Create session with list of benefits
		$session = session();
        $session->set('benefitsList', $benefitsList);

		//Call model function to get current details
		$assignedBenefit = $editAssignedBenefitModel->employeeBenefitFocus($detail_ID);

		//Create a session to store the details of the selected assigned benefit
	    $session->set('assignedBenefit', $assignedBenefit);

		//Display page
		return view('admin/employees/editassignedbenefit');
	}

	//function to process the edit of an assigned benefit
	public function processEditAssignedBenefit($detail_ID, $employee_id, $benefit_ID)
	{
		//Create an instance of the model
		$processEditAssignBenefitModel = new EmployeeBenefitsModel();

		//Retrieve form data from assignBenefit() page [Post]
		if($this->request->getMethod() === 'post')
        {
        	$benefit_amount = $this->request->getPost('benefit_amount');
        }

		//Calculation of relief amount
		//Create an instance of the model
		$reliefPercentageModel = new BenefitsModel();
		//Retrieve relief percentage for the specific benefit
		$benefit = $reliefPercentageModel->benefitFocus($benefit_ID);
		$relief_percentage = $benefit["relief_percentage"];
		//Calculate relief amount
		$relief_amount = $benefit_amount * ($relief_percentage/100);

		//Send to model
		$confirmation = $processEditAssignBenefitModel->editEmployeeBenefit($employee_id, $benefit_amount, $relief_amount);

		//Redirect back to loadAssignmentsMenu()
		return redirect()->to('/admin/employees/viewassignedbenefits/'.$employee_id);
	}

	//function to load the confirm delete assigned benefit view
	public function confirmDeleteAssignedBenefit($employee_ID, $detail_ID){
		$data["employee_ID"] = $employee_ID;
		$data["detail_ID"] = $detail_ID;
		return view('admin/employees/confirmdeleteassignedbenefit', $data);
	}

	//function to delete an assigned benefit
	public function deleteAssignedBenefit($employee_ID, $detail_ID)
	{
		//Create an instance of the model
		$deleteAssignedBenefitModel = new EmployeeBenefitsModel();

		//Call model function
		$deleteBenefit = $deleteAssignedBenefitModel->deleteEmployeeBenefit($detail_ID);

		//Redirect to viewAssignedBenefits
		return redirect()->to('/admin/employees/viewassignedbenefits/'.$employee_ID); 
	}

	//function to load the page with all allowances assigned to employee
	public function viewAssignedAllowances($employee_id)
	{
		//Retrieve the employee id
		$data["employee_id"] = $employee_id;

		//Create an instance of the models
		$allAllowancesModel = new AllowancesModel();
		$allEmployeesModel = new EmployeeModel();
		$viewAssignedAllowanceModel = new EmployeeAllowancesModel();

		//Retrieve all allowances
		$allowancesList = $allAllowancesModel->viewAllAllowances();

		//Retrieve all employees
		$employeesList = $allEmployeesModel->viewAllEmployees();

		//Create session with list of allowances
		$session = session();
        $session->set('allowancesList', $allowancesList);

		//Create a session with list of employees
        $session->set('employeesList', $employeesList);

		//Retrieve the list of allowances for the employee
		$employeeAllowancesList = $viewAssignedAllowanceModel->viewSpecificEmployeeAllowances($employee_id);

		//Create session with list of allowances for the employee
        $session->set('employeeAllowancesList', $employeeAllowancesList);

		//Display page
		return view('admin/employees/viewassignedallowances', $data);
	}

	//function to load the page to edit an assigned allowance
	public function editAssignedAllowance($detail_ID)
	{
		//Create an instance of the models
		$allAllowancesModel = new AllowancesModel();
		$editAssignedAllowanceModel = new EmployeeAllowancesModel();

		//Retrieve all allowances
		$allowancesList = $allAllowancesModel->viewAllAllowances();

		//Create session with list of allowances
		$session = session();
        $session->set('allowancesList', $allowancesList);

		//Call model function to get current details
		$assignedAllowance = $editAssignedAllowanceModel->employeeAllowanceFocus($detail_ID);

		//Create a session to store the details of the selected assigned allowance
	    $session->set('assignedAllowance', $assignedAllowance);

		//Display page
		return view('admin/employees/editassignedallowance');
	}

	//function to process the edit of an assigned allowance
	public function processEditAssignedAllowance($detail_ID, $employee_id)
	{
		//Create an instance of the model
		$processEditAssignAllowanceModel = new EmployeeAllowancesModel();

		//Retrieve form data from assignAllowance() page [Post]
		if($this->request->getMethod() === 'post')
        {
        	$amount = $this->request->getPost('amount');
        }

		//Send to model
		$confirmation = $processEditAssignAllowanceModel->editEmployeeAllowance($detail_ID, $amount);

		//Redirect back to loadAssignmentsMenu()
		return redirect()->to('/admin/employees/viewassignedallowances/'.$employee_id);
	}

	//function to load the confirm delete assigned allowance view
	public function confirmDeleteAssignedAllowance($employee_ID, $detail_ID){
		$data["employee_ID"] = $employee_ID;
		$data["detail_ID"] = $detail_ID;
		return view('admin/employees/confirmdeleteassignedallowance', $data);
	}

	//function to delete an assigned allowance
	public function deleteAssignedAllowance($employee_ID, $detail_ID)
	{
		//Create an instance of the model
		$deleteAssignedAllowanceModel = new EmployeeAllowancesModel();

		//Call model function
		$deleteAllowance = $deleteAssignedAllowanceModel->deleteEmployeeAllowance($detail_ID);

		//Redirect to viewAssignedAllowances
		return redirect()->to('/admin/employees/viewassignedallowances/'.$employee_ID); 
	}

	//function to load the page with all deductions assigned to employee
	public function viewAssignedDeductions($employee_id)
	{
		//Retrieve the employee id
		$data["employee_id"] = $employee_id;

		//Create an instance of the models
		$allDeductionsModel = new DeductionsModel();
		$allEmployeesModel = new EmployeeModel();
		$viewAssignedDeductionModel = new EmployeeDeductionsModel();

		//Retrieve all deductions
		$deductionsList = $allDeductionsModel->viewAllDeductions();

		//Retrieve all employees
		$employeesList = $allEmployeesModel->viewAllEmployees();

		//Create session with list of deductions
		$session = session();
        $session->set('deductionsList', $deductionsList);

		//Create a session with list of employees
        $session->set('employeesList', $employeesList);

		//Retrieve the list of deductions for the employee
		$employeeDeductionsList = $viewAssignedDeductionModel->viewSpecificEmployeeDeductions($employee_id);

		//Create session with list of deductions for the employee
        $session->set('employeeDeductionsList', $employeeDeductionsList);

		//Display page
		return view('admin/employees/viewassigneddeductions', $data);
	}

	//function to load the page to edit an assigned deduction
	public function editAssignedDeduction($detail_ID)
	{
		//Create an instance of the models
		$allDeductionsModel = new DeductionsModel();
		$editAssignedDeductionModel = new EmployeeDeductionsModel();

		//Retrieve all deductions
		$deductionsList = $allDeductionsModel->viewAllDeductions();

		//Create session with list of deductions
		$session = session();
        $session->set('deductionsList', $deductionsList);

		//Call model function to get current details
		$assignedDeduction = $editAssignedDeductionModel->employeeDeductionFocus($detail_ID);

		//Create a session to store the details of the selected assigned deduction
	    $session->set('assignedDeduction', $assignedDeduction);

		//Display page
		return view('admin/employees/editassigneddeduction');
	}

	//function to process the edit of an assigned deduction
	public function processEditAssignedDeduction($detail_ID, $employee_id)
	{
		//Create an instance of the model
		$processEditAssignDeductionModel = new EmployeeDeductionsModel();

		//Retrieve form data from assignDeduction() page [Post]
		if($this->request->getMethod() === 'post')
        {
        	$amount = $this->request->getPost('amount');
        }

		//Send to model
		$confirmation = $processEditAssignDeductionModel->editEmployeeDeduction($detail_ID, $amount);

		//Redirect back to loadAssignmentsMenu()
		return redirect()->to('/admin/employees/viewassigneddeductions/'.$employee_id);
	}

	//function to load the confirm delete assigned deduction view
	public function confirmDeleteAssignedDeduction($employee_ID, $detail_ID){
		$data["employee_ID"] = $employee_ID;
		$data["detail_ID"] = $detail_ID;
		return view('admin/employees/confirmdeleteassigneddeduction', $data);
	}

	//function to delete an assigned deduction
	public function deleteAssignedDeduction($employee_ID, $detail_ID)
	{
		//Create an instance of the model
		$deleteAssignedDeductionModel = new EmployeeDeductionsModel();

		//Call model function
		$deleteDeduction = $deleteAssignedDeductionModel->deleteEmployeeDeduction($detail_ID);

		//Redirect to viewAssignedDeductions
		return redirect()->to('/admin/employees/viewassigneddeductions/'.$employee_ID); 
	}

	//public function to view an employee's payslip
	public function employeePayslip($employee_id)
	{
		//Session to store employee_id
		$session = session();
		$session->set('employeePayslipFocus', $employee_id);

		//----------------------------------------------------------------------

		//COMPUTE TOTALS
		//A. Update totals for benefits, relief, deductions and allowances from payslip
		$updateDetailsModel = new PayslipModel();

		//Allowance update
		$updateDetailsModel->totalAllowances($employee_id);

		//Deductions update
		$updateDetailsModel->totalDeductions($employee_id);

		//Benefits Update
		$updateDetailsModel->totalBenefits($employee_id);

		//Deductions update
		$updateDetailsModel->totalRelief($employee_id);

		//------------------------------------------------------------------
		//COMPUTE PAYE

		//A. Compute taxable income and net salary
		//Model instance
		$computeTaxableAndNetModel = new PayslipModel();

		//Call model function
		$confirmation = $computeTaxableAndNetModel->computeTaxableAndNet($employee_id);

		//B. Compute PAYE
		//Model instance
		$computePayeModel = new TaxBracketModel();

		//Call model function
		$confirmation = $computePayeModel->computePaye($employee_id);

		//--------------------------------------------------------------------

		//Create an instance of the model
		$viewEmployeePayslip = new PayslipModel();

		//Retrieve employee payslip
		$employeePayslip = $viewEmployeePayslip->payslip($employee_id);

		//Create session with the payslip details
		$session = session();
        $session->set('employeePayslip', $employeePayslip);

		//If function to check if ready and redirect to page with either the payslip or an error message


		//Return view
		//return view('');
	}


}