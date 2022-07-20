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
        <h1>EDIT GROSS SALARY</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/employees/viewemployeesfinancials">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="form">
        <form method="post" action="/admin/employees/processeditgrosssalary/<?= $_SESSION["grossSalary"]["employee_id"] ?>">
            <div class="form-item-group">
                <label for="employee_id">Employee ID:</label>
                <input type="text" name="employee_id" id="employee_id" value="<?= $_SESSION["grossSalary"]["employee_id"] ?> (This field cannot be edited)" readonly>
            </div>
            <div class="form-item-group">
                <label for="gross_salary">Gross Salary:</label>
                <input type="text" name="gross_salary" id="gross_salary" placeholder="<?= $_SESSION["grossSalary"]["gross_salary"] ?>" value="<?= $_SESSION["grossSalary"]["gross_salary"] ?>" required>
            </div>
            <button class="submit-btn" type="submit">Edit</button>
        </form>
    </div>

    
    
<?php $this->endSection(); ?>