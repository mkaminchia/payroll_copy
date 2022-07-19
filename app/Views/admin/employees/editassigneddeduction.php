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
        <h1>EDIT DEDUCTION</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/employees/viewassigneddeductions/<?= $_SESSION["assignedDeduction"]["employee_id"]; ?>">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="form">
        <form method="post" action="/admin/employees/processeditassigneddeduction/<?= $_SESSION["assignedDeduction"]["detail_ID"]; ?>/<?= $_SESSION["assignedDeduction"]["employee_id"]; ?>">
            <div class="form-item-group">
                <label for="detail_ID">Detail ID:</label>
                <input type="text" name="detail_ID" id="detail_ID" value="<?= $_SESSION["assignedDeduction"]["detail_ID"]; ?> (This field cannot be edited)" readonly>
            </div>
            <div class="form-item-group">
                <label for="employee_id">Employee ID:</label>
                <input type="text" name="employee_id" id="employee_id" value="<?= $_SESSION["assignedDeduction"]["employee_id"]; ?> (This field cannot be edited)" readonly>
            </div>
            <?php 
                                    foreach($_SESSION["deductionsList"] as $deduction)
                                    {
                                        if($deduction["deduction_id"] == $_SESSION["assignedDeduction"]["deduction_id"] )
                                        {
            ?>
                                            <div class="form-item-group">
                                                <label for="deduction_name">Deduction Name:</label>
                                                <input type="text" name="deduction_name" id="deduction_name" value="<?= $deduction["deduction_name"]?> (This field cannot be edited)" readonly>
                                            </div>
            <?php
                                        }
                                    }
                                ?>
            
            <div class="form-item-group">
                <label for="amount">Deduction Amount:</label>
                <input type="text" name="amount" id="amount" placeholder="<?= $_SESSION["assignedDeduction"]["amount"]?>" value="<?= $_SESSION["assignedDeduction"]["amount"]?>" required>
            </div>
            <button class="submit-btn" type="submit">Edit</button>
        </form>
    </div>

    
    
<?php $this->endSection(); ?>