<?php 
    $session = session();

    $this->extend('/templates/admin_template');

    $this->section('content');
 
?>

    <script>
        var c = document.getElementById("employee");
        c.className += " active";
    </script>

    <div class="welcome-div">
        <h1>ADD AN EMPLOYEE</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/employees">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="form">
        <form method="post" action="/admin/employees/processaddemployee">
            <div class="form-item-group">
                <label for="role_id">Select Role:</label>
                <select class="form-dropdown" name="role_id" id="role_id" required>
                    <option selected disabled>Select a role</option>
                    <?php foreach($_SESSION["rolesList"] as $role){ ?>
                    <option value="<?php echo $role["role_id"]; ?>"><?php echo $role["role_name"]; ?></option>
                    <?php } ?> 
                </select>
            </div>
            <div class="form-item-group">
                <label for="firstname">First Name:</label>
                <input type="text" name="firstname" id="firstname" required>
            </div>
            <div class="form-item-group">
                <label for="surname">Surname:</label>
                <input type="text" name="surname" id="surname" required>
            </div>
            <div class="form-item-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-item-group">
                <label for="age">Age:</label>
                <input type="age" name="age" id="age" required>
            </div>
            <div class="form-item-group">
                <label for="phone_no">Phone Number:</label>
                <input type="text" name="phone_no" id="phone_no" required>
            </div>
            <div class="form-item-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" minlength="8" required>
            </div>
            <button class="submit-btn" type="submit">Add</button>
        </form>
    </div>
    
    
<?php $this->endSection(); ?>