<?php 
    $session = session();

    $this->extend('/templates/admin_template');

    $this->section('content');
 
?>

    <script>
        var c = document.getElementById("profile");
        c.className += " active";
    </script>

    <div class="welcome-div">
        <h1>PROFILE MENU</h1>
    </div>

    <div class="row justify-content-center cards-div">
        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin/profile/viewprofile">
                <img class="card-img-top" src="../images/view.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">View Profile</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin/financials">
                <img class="card-img-top" src="../images/edit.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Edit Profile</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin/financials">
                <img class="card-img-top" src="../images/delete.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Delete my Account</h5>         
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