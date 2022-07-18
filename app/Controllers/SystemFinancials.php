<?php

namespace App\Controllers;

use App\Models\BenefitsModel;
use App\Models\NhifModel;
use App\Models\NssfModel;
use App\Models\AllowancesModel;
use App\Models\DeductionsModel;

class SystemFinancials extends BaseController
{
	//function to view the benefits page
	public function viewBenefits()
	{
		//Create an instance of the model
		$viewBenefitsModel = new BenefitsModel();

		//Call the model function
		$benefitsList = $viewBenefitsModel->viewAllBenefits();

		//Store all the retrieved benefits in a session variable
		$session = session();
        $session->set('benefitsList', $benefitsList);

		//View the page
		return view('admin/financials/benefits/viewbenefits');
	}

	//function to load the confirm delete allowance view
	public function confirmDeleteBenefit($benefit_ID){
		$data["benefit_ID"] = $benefit_ID;
		return view('admin/financials/benefits/confirmdeletebenefit', $data);
	}

	//function to delete a selected benefit
	public function deleteBenefit($benefit_ID)
	{
		//Create an instance of the model
		$deleteBenefitModel = new BenefitsModel();

		//Call model function
		$deleteBenefit = $deleteBenefitModel->deleteBenefit($benefit_ID);

		//Redirect to viewBenefits
		return redirect()->to('/admin/financials/benefits/viewbenefits'); 
	}

	//function to view the page to add a benefit
	public function addBenefit()
	{
		return view('admin/financials/benefits/addbenefit');
	}

	//function to process the addition of a benefit
	public function processAddBenefit()
	{
		//Create model instance
		$addBenefitModel = new BenefitsModel();

		//Retrieve form data from addBenefitPage() [Post]
		if($this->request->getMethod() === 'post')
        {
        	$benefit_name = $this->request->getPost('benefit_name');
        	$relief_percentage = $this->request->getPost('relief_percentage');
        }

		//Call model function
		$confirmation = $addBenefitModel->addBenefit($benefit_name, $relief_percentage);

		//Redirect to loadBenefitsMenu
		return redirect()->to('/admin/financials/benefits');
	}

	//function to view the page to edit a selected benefit
	public function editBenefit($benefit_ID)
	{
		//Create an instance of the model
		$benefitFocusModel = new BenefitsModel();

		//Call model function to get current details
		$benefit = $benefitFocusModel->benefitFocus($benefit_ID);

		//Create a session to store the details of the selected benefit
		$session = session();
	    $session->set('benefit', $benefit);

        //View Page
        return view('admin/financials/benefits/editbenefit');
	}

	//function to process the changes to a benefit
	public function processEditBenefit()
	{
		//Create an instance of the model
		$editBenefitModel = new BenefitsModel();

		//Retrieve the benefit_ID of the selected benefit
		$session = session();
        $benefit_ID = $_SESSION["benefit"]["benefit_ID"];

		//Retrieve form data from editBenefit() page [Post]
		if($this->request->getMethod() === 'post')
        {
        	$benefit_name = $this->request->getPost('benefit_name');
            $relief_percentage = $this->request->getPost('relief_percentage');
        }

		//Send to model
		$confirmation = $editBenefitModel->editBenefit($benefit_ID, $benefit_name, $relief_percentage);

		//Redirect back to editBenefitPage()
		return redirect()->to('/admin/financials/benefits/viewbenefits');
	}

//----------------------------------------------------------------------------------------------------

	public function nhifPage()
	{
		//Create an instance of the model
		$nhifModel = new NhifModel();

		//Call the model function
		$nhifBrackets = $nhifModel->nhifBrackets();

		//Store all the retrieved benefits in a session variable
		$session = session();
        $session->set('nhifBrackets', $nhifBrackets);

		//View the page
		//return view('');
	}

	public function nssfPage()
	{
		//Create an instance of the model
		$nssfModel = new NssfModel();

		//Call the model function
		$nssfBrackets = $nssfModel->nssfBrackets();

		//Store all the retrieved benefits in a session variable
		$session = session();
        $session->set('nssfBrackets', $nssfBrackets);

		//View the page
		//return view('');
	}

//----------------------------------------------------------------------------------------------------

	//function to view the allowances page
	public function viewAllowances()
	{
		//Create an instance of the model
		$viewAllowancesModel = new AllowancesModel();

		//Call the model function
		$allowancesList = $viewAllowancesModel->viewAllAllowances();

		//Store all the retrieved allowances in a session variable
		$session = session();
        $session->set('allowancesList', $allowancesList);

		//View the page
		return view('admin/financials/allowances/viewallowances');
	}

	//function to load the confirm delete allowance view
	public function confirmDeleteAllowance($allowance_ID){
		$data["allowance_ID"] = $allowance_ID;
		return view('admin/financials/allowances/confirmdeleteallowance', $data);
	}

	//function to delete a selected allowance
	public function deleteAllowance($allowance_ID)
	{
		//Create an instance of the model
		$deleteAllowanceModel = new AllowancesModel();

		//Call model function
		$deleteAllowance = $deleteAllowanceModel->deleteAllowance($allowance_ID);

		//Redirect to viewAllowances
		return redirect()->to('/admin/financials/allowances/viewallowances'); 
	}

	//function to view the page to add an allowance
	public function addAllowance()
	{
		return view('admin/financials/allowances/addallowance');
	}

	//function to process the addition of an allowance
	public function processAddAllowance()
	{
		//Create model instance
		$addAllowanceModel = new AllowancesModel();

		//Retrieve form data from addAllowance() page [Post]
		if($this->request->getMethod() === 'post')
        {
        	$allowance_name = $this->request->getPost('allowance_name');
        }

		//Call model function
		$confirmation = $addAllowanceModel->addAllowance($allowance_name);

		//Redirect to viewAllowances()
		return redirect()->to('/admin/financials/allowances');
	}

	//function to view the page to edit a selected allowance
	public function editAllowance($allowance_ID)
	{
		//Create an instance of the model
		$allowanceFocusModel = new AllowancesModel();

		//Call model function to get current details
		$allowance = $allowanceFocusModel->allowanceFocus($allowance_ID);

		//Create a session to store the details of the selected allowance
		$session = session();
		$session->set('allowance', $allowance);

        //View Page
        return view('admin/financials/allowances/editallowance');
	}

	//function to process the changes to an allowance
	public function processEditAllowance()
	{
		//Create an instance of the model
		$editAllowanceModel = new AllowancesModel();

		//Retrieve the allowance_ID of the selected allowance
		$session = session();
        $allowance_ID = $_SESSION["allowance"]["allowance_ID"];

		//Retrieve form data from editAllowance() page [Post]
		if($this->request->getMethod() === 'post')
        {
        	$allowance_name = $this->request->getPost('allowance_name');
        }

		//Send to model
		$confirmation = $editAllowanceModel->editAllowance($allowance_ID, $allowance_name);

		//Redirect back to editAllowancePage()
		return redirect()->to('/admin/financials/allowances/viewallowances');
	}

//----------------------------------------------------------------------------------------------------

	//function to view the deductions page
	public function viewDeductions()
	{
		//Create an instance of the model
		$viewDeductionsModel = new DeductionsModel();

		//Call the model function
		$deductionsList = $viewDeductionsModel->viewAllDeductions();

		//Store all the retrieved deductions in a session variable
		$session = session();
        $session->set('deductionsList', $deductionsList);

		//View the page
		return view('admin/financials/deductions/viewdeductions');
	}

	//function to load the confirm delete deduction view
	public function confirmDeleteDeduction($deduction_id){
		$data["deduction_id"] = $deduction_id;
		return view('admin/financials/deductions/confirmdeletededuction', $data);
	}

	//function to delete a selected deduction
	public function deleteDeduction($deduction_id)
	{
		//Create an instance of the model
		$deleteDeductionModel = new DeductionsModel();

		//Call model function
		$deleteDeduction = $deleteDeductionModel->deleteDeduction($deduction_id);

		//Redirect to viewDeductions
		return redirect()->to('/admin/financials/deductions/viewdeductions'); 
	}

	//function to view the page to add a deduction
	public function addDeduction()
	{
		return view('admin/financials/deductions/adddeduction');
	}

	//function to process the addition of a deduction
	public function processAddDeduction()
	{
		//Create model instance
		$addDeductionModel = new DeductionsModel();

		//Retrieve form data from addDeduction() page [Post]
		if($this->request->getMethod() === 'post')
        {
        	$deduction_name = $this->request->getPost('deduction_name');
        }

		//Call model function
		$confirmation = $addDeductionModel->addDeduction($deduction_name);

		//Redirect to viewDeductions()
		return redirect()->to('/admin/financials/deductions');
	}

	//function to view the page to edit a selected deduction
	public function editDeductionPage()
	{
		//Create an instance of the model
		$deductionFocusModel = new DeductionsModel();

		//Case 1: Retrieve the selected deduction from viewDeductions() [Post]
		if(isset($_GET['edit']))
	    {
	        $deduction_id = $_GET['edit'];

	        //Call model function to get current details
			$editDeductionDetails = $deductionFocusModel->deductionFocus($deduction_id);

			//Create two sessions:
				//1. To store deduction selected - editDeduction
				//2. To store the details of the selected deduction - editDeductionDetails
			$session = session();
	        $session->set('editDeduction', $deduction_id);
	        $session->set('editDeductionDetails', $editDeductionDetails);
	    }
	    //Case 2: Redirected after a deduction's details are edited
	    else if(isset($_SESSION['editDeduction']))
	    {
	    	//Call model function to get updated details
			$editDeductionDetails = $deductionFocusModel->deductionFocus($deduction_id);

			//Create a session to store the details of the selected allowance - editAllowanceDetails
			$session = session();
	        $session->set('editDeductionDetails', $editDeductionDetails);
	    }

        //View Page
        //return view('');
	}

	//function to process the changes to a deduction
	public function processEditDeduction()
	{
		//Create an instance of the model
		$editDeductionModel = new DeductionsModel();

		//Retrieve the deduction_id of the selected deduction
		$session = session();
        $deduction_id = $session->get('editDeduction');

		//Retrieve form data from editDeduction() page [Post]
		if($this->request->getMethod() === 'post')
        {
        	$deduction_name = $this->request->getPost('deduction_name');
        }

		//Send to model
		$confirmation = $editDeductionModel->editDeduction($deduction_id, $deduction_name);

		//Redirect back to editDeductionPage()
		//return redirect()->to('');
	}

}