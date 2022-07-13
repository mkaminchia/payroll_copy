<?php 
    $session = session();

    $this->extend('/templates/employee_template');

    $this->section('content');
 
?>

    <script>
        var c = document.getElementById("home");
        c.className += " active";
    </script>

    <div class="welcome-div">
        <h1>WELCOME, <?= strtoupper($_SESSION["user_details"]["firstname"])?></h1>
    </div>

    <div class="row cards-div">
        <div class="card col-12 col-md-6 card-div">
            <a href="/employee/payslip">
                <img class="card-img-top" src="../images/payslip.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">View Pay Slip</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-md-6 card-div">
            <a href="/employee/profile">
                <img class="card-img-top" src="../images/profile.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">View Profile</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-md-6 card-div">
            <a href="/login/logout">
                <img class="card-img-top" src="../images/logout.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Logout</h5>         
                </div>
            </a> 
        </div>
    </div>


<?php $this->endSection(); ?>