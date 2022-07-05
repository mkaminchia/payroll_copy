<?php

namespace App\Controllers;

class Employee extends BaseController
{
    public function index()
    {
        return view('employee/dashboard');
    }
}