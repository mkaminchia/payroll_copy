<?php 
    $session = session();

    $this->extend('/templates/employee_template');

    $this->section('content');
 
?>

    <script>
        var c = document.getElementById("password");
        c.className += " active";
    </script>

    <div class="welcome-div">
        <h1>CHANGE PASSWORD</h1>
    </div>

    <div class="primary-cta">
        <a href="/employee">Return to dashboard</a>
    </div>

    <?php
        if ($session->getFlashdata('status'))
        {
    ?>
        <p style = "color: red; text-align: center; font-size: 1.3em;" class="login-error"><?= $session->getFlashdata('status'); ?></h5>
    <?php
        }
    ?>

    <div class="form">
        <form method="post" action="/employee/processchangepassword">
            <div class="form-item-group">
                <label for="old_password">Old Password:</label>
                <input type="password" name="old_password" id="old_password" minlength="8" required>
            </div>
            <div class="form-item-group">
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" id="new_password" minlength="8" required>
            </div>
            <div class="form-item-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" minlength="8" required>
            </div>
            <button class="submit-btn" type="submit">Edit</button>
        </form>
    </div>

    
    
<?php $this->endSection(); ?>