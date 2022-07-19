<?php 
    $session = session();

    $this->extend('/templates/admin_template');

    $this->section('content');
 
?>

    <script>
        var c = document.getElementById("employees");
        c.className += " active";
    </script>

    <div class="welcome-div">
        <h1>ASSIGN AN ALLOWANCE</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/employees/assignmentsmenu/<?= $employee_id; ?>">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="form">
        <form method="post" action="/admin/employees/processassignallowance/<?= $employee_id; ?>">
            <div class="form-item-group">
                <label for="employee_ID">Employee ID:</label>
                <input type="text" name="employee_ID" id="employee_ID" value="<?= $employee_id?> (This field cannot be edited)" readonly>
            </div>
            <div class="form-item-group">
                <label for="allowance_id">Select Allowance:</label>
                <select class="form-dropdown" name="allowance_ID" id="allowance_ID" required>
                    <option selected disabled>Select an allowance</option>
                    <?php foreach($_SESSION["allowancesList"] as $row){ ?>
                    <option value="<?php echo $row["allowance_ID"]; ?>"><?php echo $row["allowance_name"]; ?></option>
                    <?php } ?> 
                </select>
            </div>
            <div class="form-item-group">
                <label for="amount">Amount:</label>
                <input type="text" name="amount" id="amount" required>
            </div>
            <button class="submit-btn" type="submit">Assign</button>
        </form>
    </div>

    
    
<?php $this->endSection(); ?>