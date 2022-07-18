<?php 
    $session = session();

    $this->extend('/templates/employee_template');

    $this->section('content');
 
?>

    <script>
        var c = document.getElementById("profile");
        c.className += " active";
    </script>

    <div class="welcome-div">
        <h1>PROFILE DETAILS</h1>
    </div>

    <div class="primary-cta">
        <a href="/employee">Return to dashboard</a>
    </div>

    <div class="form">
        <form>
            <div class="form-item-group">
                <label for="employee_id">Employee ID:</label>
                <input type="text" name="employee_id" id="employee_id" value="<?= $_SESSION["user_details"]["employee_id"]?>" readonly>
            </div>
            <div class="form-item-group">
                <label for="firstname">First Name:</label>
                <input type="text" name="firstname" id="firstname" value="<?= $_SESSION["user_details"]["firstname"]?>" readonly>
            </div>
            <div class="form-item-group">
                <label for="surname">Surname:</label>
                <input type="text" name="surname" id="surname" value="<?= $_SESSION["user_details"]["surname"]?>" readonly>
            </div>
            <div class="form-item-group">
                <label for="email">E-mail:</label>
                <input type="text" name="email" id="email" value="<?= $_SESSION["user_details"]["email"]?>" readonly>
            </div>
            <div class="form-item-group">
                <label for="age">Age:</label>
                <input type="text" name="age" id="age" value="<?= $_SESSION["user_details"]["age"]?>" readonly>
            </div>
            <div class="form-item-group">
                <label for="phone_no">Phone Number:</label>
                <input type="text" name="phone_no" id="phone_no" value="<?= $_SESSION["user_details"]["phone_no"]?>" readonly>
            </div>
        </form>
    </div>

    
    
<?php $this->endSection(); ?>