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
            <a href="/admin/financials/benefits">
                <img class="card-img-top" src="../images/benefits.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Benefits Menu</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin/financials/allowances">
                <img class="card-img-top" src="../images/allowances.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Allowances Menu</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin/financials/deductions">
                <img class="card-img-top" src="../images/deductions.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Deductions Menu</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin/financials/viewtaxbrackets">
                <img class="card-img-top" src="../images/taxbrackets.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Tax Brackets</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin/financials/nhif">
                <img class="card-img-top" src="../images/nhif.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">NHIF</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin/financials/nssf">
                <img class="card-img-top" src="../images/nssf.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">NSSF</h5>         
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