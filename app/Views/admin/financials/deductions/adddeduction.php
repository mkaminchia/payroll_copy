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
        <h1>ADD A DEDUCTION</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/financials/deductions">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="form">
        <form method="post" action="/admin/financials/deductions/processadddeduction">
            <div class="form-item-group">
                <label for="deduction_name">Deduction Name:</label>
                <input type="text" name="deduction_name" id="deduction_name" required>
            </div>
            <button class="submit-btn" type="submit">Add</button>
        </form>
    </div>
    
    
<?php $this->endSection(); ?>