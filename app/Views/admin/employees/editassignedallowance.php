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
        <h1>EDIT ALLOWANCE</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/employees/viewassignedallowances/<?= $_SESSION["assignedAllowance"]["employee_id"]; ?>">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="form">
        <form method="post" action="/admin/employees/processeditassignedallowance/<?= $_SESSION["assignedAllowance"]["detail_ID"]; ?>/<?= $_SESSION["assignedAllowance"]["employee_id"]; ?>">
            <div class="form-item-group">
                <label for="detail_ID">Detail ID:</label>
                <input type="text" name="detail_ID" id="detail_ID" value="<?= $_SESSION["assignedAllowance"]["detail_ID"]; ?> (This field cannot be edited)" readonly>
            </div>
            <div class="form-item-group">
                <label for="employee_id">Employee ID:</label>
                <input type="text" name="employee_id" id="employee_id" value="<?= $_SESSION["assignedAllowance"]["employee_id"]; ?> (This field cannot be edited)" readonly>
            </div>
            <?php 
                                    foreach($_SESSION["allowancesList"] as $allowance)
                                    {
                                        if($allowance["allowance_ID"] == $_SESSION["assignedAllowance"]["allowance_ID"] )
                                        {
            ?>
                                            <div class="form-item-group">
                                                <label for="allowance_name">Allowance Name:</label>
                                                <input type="text" name="allowance_name" id="allowance_name" value="<?= $allowance["allowance_name"]?> (This field cannot be edited)" readonly>
                                            </div>
            <?php
                                        }
                                    }
                                ?>
            
            <div class="form-item-group">
                <label for="amount">Allowance Amount:</label>
                <input type="text" name="amount" id="amount" placeholder="<?= $_SESSION["assignedAllowance"]["amount"]?>" value="<?= $_SESSION["assignedAllowance"]["amount"]?>" required>
            </div>
            <button class="submit-btn" type="submit">Edit</button>
        </form>
    </div>

    
    
<?php $this->endSection(); ?>