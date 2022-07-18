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
                <img class="card-img-top" src="../../images/view.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">View Profile</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin/profile/editprofile">
                <img class="card-img-top" src="../../images/edit.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Edit Profile</h5>         
                </div>
            </a> 
        </div>

        <div class="card col-12 col-sm-4 card-div">
            <a href="#" id="myBtn">
                <img class="card-img-top" src="../../images/delete.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Delete my Account</h5>         
                </div>
            </a> 
        </div>

        <!-- The Modal -->
        <div id="myModal" class="the-modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="close-div"><a href="#" class="close">&times;</a></div>
                <div class="modal-inner-div">
                    <div class="modal-left">
                        <h2>WARNING</h2>
                        <p>Are you sure you want to delete your account?</p>
                        <div class="modal-options">
                            <a class="warning" href="/admin/profile/deleteprofile">Yes</a>
                            <a id="no" href="#">No</a>
                        </div>
                    </div>
                    <img class="modal-image" src="../../images/delete.svg" alt="Image">
                </div>
            </div>
        </div>


        <div class="card col-12 col-sm-4 card-div">
            <a href="/admin">
                <img class="card-img-top" src="../../images/logoutblue.svg" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">Return to Dashboard</h5>         
                </div>
            </a> 
        </div>
    </div>


    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // Get the <a> element that closes the modal
        var no = document.getElementById("no");

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks on <a> (no), close the modal
        no.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>


<?php $this->endSection(); ?>