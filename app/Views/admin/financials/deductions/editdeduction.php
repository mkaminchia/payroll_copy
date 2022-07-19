<?php 
    $session = session();

    $this->extend('/templates/admin_template');

    $this->section('content');
 
?>

    <script>
        var c = document.getElementById("financials");
        c.className += " active";
    </script>

    <div class="welcome-div">
        <h1>EDIT DEDUCTION</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/financials/deductions/viewdeductions">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="form">
        <form method="post" action="/admin/financials/deductions/processeditdeduction">
            <div class="form-item-group">
                <label for="deduction_id">Deduction ID:</label>
                <input type="text" name="deduction_id" id="deduction_id" value="<?= $_SESSION["deduction"]["deduction_id"]?> (This field cannot be edited)" readonly>
            </div>
            <div class="form-item-group">
                <label for="deduction_name">Deduction Name:</label>
                <input type="text" name="deduction_name" id="deduction_name" placeholder="<?= $_SESSION["deduction"]["deduction_name"]?>" value="<?= $_SESSION["deduction"]["deduction_name"]?>" required>
            </div>
            <button class="submit-btn" type="submit">Edit</button>
        </form>
    </div>

    
    
<?php $this->endSection(); ?>