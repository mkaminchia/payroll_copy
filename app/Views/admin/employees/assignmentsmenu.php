<?php 
    $session = session();

    $this->extend('/templates/admin_template');

    $this->section('content');
 
?>

    <script>
        var c = document.getElementById("employees");
        c.className += " active";
    </script>

    <div class="welcome-div">
        <h1>ASSIGN FINANCIAL TO EMPLOYEE</h1>
    </div>

    <div class="row justify-content-center cards-div">
        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin/employees/assignbenefit/<?= $employee_id; ?>">
                <img class="card-img-top" src="../../../../images/benefits.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Assign Benefit</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin/employees/assignallowance/<?= $employee_id; ?>">
                <img class="card-img-top" src="../../../../images/allowances.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Assign Allowance</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin/employees/assigndeduction/<?= $employee_id; ?>">
                <img class="card-img-top" src="../../../../images/deductions.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Assign Deduction</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin/employees/viewemployeesfinancials">
                <img class="card-img-top" src="../../../../images/back.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Go back</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin">
                <img class="card-img-top" src="../../../../images/logoutblue.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Return to Dashboard</h5>         
                </div>
            </a> 
        </div>
    </div>


<?php $this->endSection(); ?>