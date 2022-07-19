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
        <h1>ASSIGN A BENEFIT</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/employees/assignmentsmenu/<?= $employee_id; ?>">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="form">
        <form method="post" action="/admin/employees/processassignbenefit/<?= $employee_id; ?>">
            <div class="form-item-group">
                <label for="employee_ID">Employee ID:</label>
                <input type="text" name="employee_ID" id="employee_ID" value="<?= $employee_id?> (This field cannot be edited)" readonly>
            </div>
            <div class="form-item-group">
                <label for="benefit_ID">Select Benefit:</label>
                <select class="form-dropdown" name="benefit_ID" id="benefit_ID" required>
                    <option selected disabled>Select a Benefit</option>
                    <?php foreach($_SESSION["benefitsList"] as $row){ ?>
                    <option value="<?php echo $row["benefit_ID"]; ?>"><?php echo $row["benefit_name"]; ?></option>
                    <?php } ?> 
                </select>
            </div>
            <div class="form-item-group">
                <label for="benefit_amount">Benefit Amount:</label>
                <input type="text" name="benefit_amount" id="benefit_amount" required>
            </div>
            <button class="submit-btn" type="submit">Assign</button>
        </form>
    </div>

    
    
<?php $this->endSection(); ?>