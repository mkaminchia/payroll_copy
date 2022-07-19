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
        <h1>EDIT EMPLOYEE PROFILE</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/employees/viewemployeespersonals">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="form">
        <form method="post" action="/admin/employees/processeditemployeepersonals">
            <div class="form-item-group">
                <label for="employee_id">Employee ID:</label>
                <input type="text" name="employee_id" id="employee_id" value="<?= $_SESSION["employee"]["employee_id"]?> (This field cannot be edited)" readonly>
            </div>
            <div class="form-item-group">
                <label for="firstname">First Name:</label>
                <input type="text" name="firstname" id="firstname" placeholder="<?= $_SESSION["employee"]["firstname"]?>" value="<?= $_SESSION["employee"]["firstname"]?>" required>
            </div>
            <div class="form-item-group">
                <label for="surname">Surname:</label>
                <input type="text" name="surname" id="surname" placeholder="<?= $_SESSION["employee"]["surname"]?>" value="<?= $_SESSION["employee"]["surname"]?>" required>
            </div>
            <div class="form-item-group">
                <label for="email">E-mail:</label>
                <input type="text" name="email" id="email" placeholder="<?= $_SESSION["employee"]["email"]?>" value="<?= $_SESSION["employee"]["email"]?>" required>
            </div>
            <div class="form-item-group">
                <label for="age">Age:</label>
                <input type="text" name="age" id="age" placeholder="<?= $_SESSION["employee"]["age"]?>" value="<?= $_SESSION["employee"]["age"]?>" required>
            </div>
            <div class="form-item-group">
                <label for="phone_no">Phone Number:</label>
                <input type="text" name="phone_no" id="phone_no" placeholder="<?= $_SESSION["employee"]["phone_no"]?>" value="<?= $_SESSION["employee"]["phone_no"]?>" required>
            </div>
            <button class="submit-btn" type="submit">Edit</button>
        </form>
    </div>

    
    
<?php $this->endSection(); ?>