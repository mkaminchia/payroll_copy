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
        <a href="/admin/employees/viewassignedbenefits/<?= $employee_ID; ?>">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div style="margin-bottom: 0;" class="not-found">
            <p>Are you sure you would like to delete this assigned benefit?</p>
    </div>

    <div style="margin-top: 0;" class="primary-cta">
        <a class="table-btn" href="/admin/employees/viewassignedbenefits/<?= $employee_ID; ?>">No</a>
        <a class="table-btn" href="/admin/employees/deleteassignedbenefit/<?= $employee_ID; ?>/<?= $detail_ID; ?>">Yes</a>
    </div>
    
    
    
<?php $this->endSection(); ?>