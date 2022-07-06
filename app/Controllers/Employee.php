<?php

namespace App\Controllers;

//Give the Employee controller access to the 'employee.php' file
use App\Models\employee;

class Employee extends BaseController
{
    public function index()
    {
        return view('employee/dashboard');
    }

    //function to handle the Login Backend functionality
    public function processLogin()
    {
        //1. Create an instance of the model
        $loginModel = new employee();

        //Temporary checkpoint
        echo "Model instance successfully created<br>";

        //2. Retrieve form data
        if($this->request->getMethod() === 'post')
        {
            $email = $this->request->getPost('email');
            $password  = $this->request->getPost('password');
        }

        //Temporary Checkpoint
        echo "<br>Data retrieved from form successfully!";
        echo "<br>Email - ".$email;
        echo "<br>Password - ".$password;


        //3. Method function call
        $user_info = $loginModel->login($email, $password);

        //Model Test
        echo "<br><br>Result: ";
        print_r($user_info);

        //4. If array is empty:
        if(empty($user_info))
        {
            //-> EMPTY: Redirect to login page
            return redirect()->to('Employee/index');
        }
        else
        {
            //-> NOT EMPTY: Create a session to store user info and redirect to employee dashboard or admin dashboard
            $session = session();
            $session->set('user_details', $user_info);

            //Admin or User clearance level
            if($user_info['role_id'] == "0")
            {
                echo "<br>Employee Account";
                //return redirect()->to('');
            }
            elseif($user_info['role_id'] == "1")
            {
                echo "<br>Admin Account";
                //return redirect()->to('');
            }
        }
    }

}