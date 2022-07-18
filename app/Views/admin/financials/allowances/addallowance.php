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
        <h1>ADD AN ALLOWANCE</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/financials/allowances">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="form">
        <form method="post" action="/admin/financials/allowances/processaddallowance">
            <div class="form-item-group">
                <label for="allowance_name">Allowance Name:</label>
                <input type="text" name="allowance_name" id="allowance_name" required>
            </div>
            <button class="submit-btn" type="submit">Add</button>
        </form>
    </div>
    
    
<?php $this->endSection(); ?>