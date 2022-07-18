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
        <h1>CONFIRM DELETION</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/financials/allowances/viewallowances">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div style="margin-bottom: 0;" class="not-found">
            <p>Are you sure you would like to delete this allowance?</p>
    </div>

    <div style="margin-top: 0;" class="primary-cta">
        <a class="table-btn" href="/admin/financials/allowances/viewallowances">No</a>
        <a class="table-btn" href="/admin/financials/allowances/deleteallowance/<?= $allowance_id; ?>">Yes</a>
    </div>
    
    
    
<?php $this->endSection(); ?>