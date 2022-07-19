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
        <h1>EDIT BENEFIT</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/employees/viewassignedbenefits/<?= $_SESSION["assignedBenefit"]["employee_id"]; ?>">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="form">
        <form method="post" action="/admin/employees/processeditassignedbenefit/<?= $_SESSION["assignedBenefit"]["detail_ID"]; ?>/<?= $_SESSION["assignedBenefit"]["employee_id"]; ?>/<?= $_SESSION["assignedBenefit"]["benefit_ID"]; ?>">
            <div class="form-item-group">
                <label for="detail_ID">Detail ID:</label>
                <input type="text" name="detail_ID" id="detail_ID" value="<?= $_SESSION["assignedBenefit"]["detail_ID"]; ?> (This field cannot be edited)" readonly>
            </div>
            <div class="form-item-group">
                <label for="employee_id">Employee ID:</label>
                <input type="text" name="employee_id" id="employee_id" value="<?= $_SESSION["assignedBenefit"]["employee_id"]; ?> (This field cannot be edited)" readonly>
            </div>
            <?php 
                                    foreach($_SESSION["benefitsList"] as $benefit)
                                    {
                                        if($benefit["benefit_ID"] == $_SESSION["assignedBenefit"]["benefit_ID"] )
                                        {
            ?>
                                            <div class="form-item-group">
                                                <label for="benefit_name">Benefit Name:</label>
                                                <input type="text" name="benefit_name" id="benefit_name" value="<?= $benefit["benefit_name"]?> (This field cannot be edited)" readonly>
                                            </div>
            <?php
                                        }
                                    }
                                ?>
            
            <div class="form-item-group">
                <label for="benefit_amount">Benefit Amount:</label>
                <input type="text" name="benefit_amount" id="benefit_amount" placeholder="<?= $_SESSION["assignedBenefit"]["benefit_amount"]?>" value="<?= $_SESSION["assignedBenefit"]["benefit_amount"]?>" required>
            </div>
            <button class="submit-btn" type="submit">Edit</button>
        </form>
    </div>

    
    
<?php $this->endSection(); ?>