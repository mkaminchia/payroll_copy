<?php 
    $session = session();

    $this->extend('/templates/admin_template');

    $this->section('content');
 
?>

    <script>
        var c = document.getElementById("home");
        c.className += " active";
    </script>

    <div class="welcome-div">
        <h1>WELCOME, <?= strtoupper($_SESSION["user_details"]["firstname"])?></h1>
    </div>

    <div class="row justify-content-center cards-div">
        <div class="card col-12 col-sm-6 col-md-3 card-div">
            <a href="/admin/profile">
                <img class="card-img-top" src="../images/profileblue.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Profile Menu</h5>         
                </div>
            </a> 
        </div>
        
        <div class="card col-12 col-sm-6 col-md-3 card-div">
            <a href="/admin/employees">
                <img class="card-img-top" src="../images/employee.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Employees Menu</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-6 col-md-3 card-div">
            <a href="/admin/financials">
                <img class="card-img-top" src="../images/financials.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Financials Menu</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-6 col-md-3 card-div">
            <a href="/login/logout">
                <img class="card-img-top" src="../images/logoutblue.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Logout</h5>         
                </div>
            </a> 
        </div>
    </div>


<?php $this->endSection(); ?>