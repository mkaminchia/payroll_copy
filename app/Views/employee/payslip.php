<?php 
    $session = session();

    $this->extend('/templates/employee_template');

    $this->section('content');
 
?>

    <script>
        var c = document.getElementById("payslip");
        c.className += " active";
    </script>

    <div class="welcome-div">
        <h1>PAY SLIP</h1>
    </div>

    <div class="primary-cta">
        <a href="/employee">Return to dashboard</a>
    </div>

    <?php if(isset($_SESSION["payslip"])){ ?>
        <div class="form">
            <form>
                <div class="form-item-group">
                    <label for="employee_id">Employee ID:</label>
                    <input type="text" name="employee_id" id="employee_id" value="<?= $_SESSION["user_details"]["employee_id"]?>" readonly>
                </div>
                <div class="form-item-group">
                    <label for="gross_salary">Gross Salary:</label>
                    <input type="text" name="gross_salary" id="gross_salary" value="<?= $_SESSION["payslip"]["gross_salary"]?>" readonly>
                </div>
                <div class="form-item-group">
                    <label for="paye">Income Tax:</label>
                    <input type="text" name="paye" id="paye" value="<?= $_SESSION["payslip"]["paye"]?>" readonly>
                </div>
                <div class="form-item-group">
                    <label for="net_salary">Net Salary:</label>
                    <input type="text" name="net_salary" id="net_salary" value="<?= $_SESSION["payslip"]["net_salary"]?>" readonly>
                </div>
            </form>
        </div>
    <?php } else { ?>
        <div class="not-found">
            <p>Sorry, your pay slip is yet to be computed</p>
        </div>
    <?php } ?>

    
    
<?php $this->endSection(); ?>