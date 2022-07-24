<?php

namespace App\Controllers;

use App\Models\EmployeeModel;

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }

    //function to handle the Login Backend functionality
    public function processLogin()
    {
        //1. Create an instance of the model
        $loginModel = new EmployeeModel();

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
        $hashedPassword = $loginModel->getPassword($email);
        
        //If no user exists
        if(empty($hashedPassword))
        {
            //-> EMPTY: Redirect to login page
            return redirect()->to('/')->with('status', 'The e-mail or password is incorrect.');
        }

        if(password_verify($password, $hashedPassword))
        {
            $user_info = $loginModel->login($email, $password);

            if($user_info["is_deleted"] == 0)
            {
                //-> NOT EMPTY: Create a session to store user info and redirect to employee dashboard or admin dashboard
                $session = session();
                $session->set('user_details', $user_info);

                //Admin or User clearance level
                if($user_info['role_id'] == "1")
                {
                    return redirect()->to('/employee');
                }
                elseif($user_info['role_id'] == "2")
                {
                    return redirect()->to('/admin');
                }
            } else{
                //-> EMPTY: Redirect to login page
                return redirect()->to('/')->with('status', 'The e-mail or password is incorrect.');
            }
        } else{
            //-> EMPTY: Redirect to login page
            return redirect()->to('/')->with('status', 'The e-mail or password is incorrect.');
        }

        

        //Model Test
        echo "<br><br>Result: ";
        print_r($user_info);

        //4. If array is empty:
        if(empty($user_info))
        {
            //-> EMPTY: Redirect to login page
            return redirect()->to('/')->with('status', 'This user does not exist/The password is incorrect. Contact an admin for assistance.');
        }
        elseif($user_info['is_deleted'] == 1)
        {
            //-> EMPTY: Redirect to login page
            return redirect()->to('/')->with('status', 'This user has been deleted. Contact an admin for assistance.');
        }
        else
        {
           
        }
    }

    //Function to logout
    public function logout()
    {
		$session = session();
		unset($_SESSION["user_details"]);
		return redirect()->to("/");
	}
}
