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
        <h1>ALLOWANCES MENU</h1>
    </div>

    <div class="row justify-content-center cards-div">
        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin/financials/allowances/addallowance">
                <img class="card-img-top" src="../../../images/add.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Add Allowance</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin/financials/allowances/viewallowances">
                <img class="card-img-top" src="../../../images/view.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">View Allowances</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin/financials">
                <img class="card-img-top" src="../../../images/back.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Go back</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin">
                <img class="card-img-top" src="../../../images/logoutblue.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Return to Dashboard</h5>         
                </div>
            </a> 
        </div>
    </div>


<?php $this->endSection(); ?>