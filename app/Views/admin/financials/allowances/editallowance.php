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
        <h1>EDIT ALLOWANCE</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/financials/allowances/viewallowances">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="form">
        <form method="post" action="/admin/financials/allowances/processeditallowance">
            <div class="form-item-group">
                <label for="allowance_ID">Allowance ID:</label>
                <input type="text" name="allowance_ID" id="allowance_ID" value="<?= $_SESSION["allowance"]["allowance_ID"]?> (This field cannot be edited)" readonly>
            </div>
            <div class="form-item-group">
                <label for="allowance_name">Allowance Name:</label>
                <input type="text" name="allowance_name" id="allowance_name" placeholder="<?= $_SESSION["allowance"]["allowance_name"]?>" value="<?= $_SESSION["allowance"]["allowance_name"]?>" required>
            </div>
            <button class="submit-btn" type="submit">Edit</button>
        </form>
    </div>

    
    
<?php $this->endSection(); ?>