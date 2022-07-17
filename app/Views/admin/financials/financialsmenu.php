<?php 
    $session = session();

    $this->extend('/templates/admin_template');

    $this->section('content');
 
?>

    <script>
        var c = document.getElementById("financials");
        c.className += " active";
    </script>

    <div class="welcome-div">
        <h1>FINANCIALS MENU</h1>
    </div>

    <div class="row justify-content-center cards-div">
        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin/employees">
                <img class="card-img-top" src="../images/personals.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Benefits Menu</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin/financials">
                <img class="card-img-top" src="../images/employeefinancials.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Allowances Menu</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin/financials">
                <img class="card-img-top" src="../images/employeefinancials.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Deductions Menu</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin">
                <img class="card-img-top" src="../images/logoutblue.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Return to Dashboard</h5>         
                </div>
            </a> 
        </div>
    </div>


<?php $this->endSection(); ?>