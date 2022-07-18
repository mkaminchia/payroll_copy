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
        <h1>ADD A BENEFIT</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/financials/benefits">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="form">
        <form method="post" action="/admin/financials/benefits/processaddbenefit">
            <div class="form-item-group">
                <label for="benefit_name">Benefit Name:</label>
                <input type="text" name="benefit_name" id="benefit_name" required>
            </div>
            <div class="form-item-group">
                <label for="relief_percentage">Relief Percentage:</label>
                <input type="text" name="relief_percentage" id="relief_percentage" required>
            </div>
            <button class="submit-btn" type="submit">Add</button>
        </form>
    </div>
    
    
<?php $this->endSection(); ?>