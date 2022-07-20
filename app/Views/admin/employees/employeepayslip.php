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
        <h1>VIEW EMPLOYEE PAY SLIP</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/employees/viewemployeesfinancials">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <?php if($_SESSION["employeePayslip"]["gross_salary"] == 0) { ?>
        <div class="not-found">
            <p>You cannot view this user's payslip without assigning a gross salary</p>
        </div>
        <div style="margin-top: -2em;" class="primary-cta">
            <a href="/admin/employees/editgrosssalary/<?= $_SESSION["employeePayslip"]["employee_id"] ?>">Assign Gross Salary</a>
        </div>
    <?php } else{ ?>
        <div class="form">
            <form>
                <div class="form-item-group">
                    <label for="employee_id">Employee ID:</label>
                    <input type="text" name="employee_id" id="employee_id" value="<?= $_SESSION["employeePayslip"]["employee_id"]?>" readonly>
                </div>
                <div class="form-item-group">
                    <label for="gross_salary">Gross Salary:</label>
                    <input type="text" name="gross_salary" id="gross_salary" value="<?= $_SESSION["employeePayslip"]["gross_salary"]?> KSH" readonly>
                </div>
                <div class="form-item-group">
                    <label for="total_allowance">Total Allowances:</label>
                    <input type="text" name="total_allowance" id="total_allowance" value="<?= $_SESSION["employeePayslip"]["total_allowance"]?> KSH" readonly>
                </div>
                <div class="form-item-group">
                    <label for="total_deductions">Total Deductions:</label>
                    <input type="text" name="total_deductions" id="total_deductions" value="<?= $_SESSION["employeePayslip"]["total_deductions"]?> KSH" readonly>
                </div>
                <div class="form-item-group">
                    <label for="total_benefits">Total Benefits:</label>
                    <input type="text" name="total_benefits" id="total_benefits" value="<?= $_SESSION["employeePayslip"]["total_benefits"]?> KSH" readonly>
                </div>
                <div class="form-item-group">
                    <label for="total_relief">Total Relief:</label>
                    <input type="text" name="total_relief" id="total_relief" value="<?= $_SESSION["employeePayslip"]["total_relief"]?> KSH" readonly>
                </div>
                <div class="form-item-group">
                    <label for="taxable_income">Taxable Income:</label>
                    <input type="text" name="taxable_income" id="taxable_income" value="<?= $_SESSION["employeePayslip"]["taxable_income"]?> KSH" readonly>
                </div>
                <div class="form-item-group">
                    <label for="paye">Income Tax:</label>
                    <input type="text" name="paye" id="paye" value="<?= $_SESSION["employeePayslip"]["paye"]?> KSH" readonly>
                </div>
                <div class="form-item-group">
                    <label for="net_salary">Net Salary:</label>
                    <input type="text" name="net_salary" id="net_salary" value="<?= $_SESSION["employeePayslip"]["net_salary"]?> KSH" readonly>
                </div>
            </form>
        </div>
    <?php } ?>
    
    
    
<?php $this->endSection(); ?>