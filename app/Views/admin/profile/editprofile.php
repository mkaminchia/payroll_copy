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
        <h1>EDIT YOUR PROFILE</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/profile">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="form">
        <form method="post" action="/admin/profile/processeditprofile">
            <div class="form-item-group">
                <label for="employee_id">Employee ID:</label>
                <input type="text" name="employee_id" id="employee_id" value="<?= $_SESSION["user_details"]["employee_id"]?> (This field cannot be edited)" readonly>
            </div>
            <div class="form-item-group">
                <label for="firstname">First Name:</label>
                <input type="text" name="firstname" id="firstname" placeholder="<?= $_SESSION["user_details"]["firstname"]?>" value="<?= $_SESSION["user_details"]["firstname"]?>">
            </div>
            <div class="form-item-group">
                <label for="surname">Surname:</label>
                <input type="text" name="surname" id="surname" placeholder="<?= $_SESSION["user_details"]["surname"]?>" value="<?= $_SESSION["user_details"]["surname"]?>">
            </div>
            <div class="form-item-group">
                <label for="email">E-mail:</label>
                <input type="text" name="email" id="email" placeholder="<?= $_SESSION["user_details"]["email"]?>" value="<?= $_SESSION["user_details"]["email"]?>">
            </div>
            <div class="form-item-group">
                <label for="age">Age:</label>
                <input type="text" name="age" id="age" placeholder="<?= $_SESSION["user_details"]["age"]?>" value="<?= $_SESSION["user_details"]["age"]?>">
            </div>
            <div class="form-item-group">
                <label for="phone_no">Phone Number:</label>
                <input type="text" name="phone_no" id="phone_no" placeholder="<?= $_SESSION["user_details"]["phone_no"]?>" value="<?= $_SESSION["user_details"]["phone_no"]?>">
            </div>
            <button class="submit-btn" type="submit">Edit</button>
        </form>
    </div>

    
    
<?php $this->endSection(); ?>