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
        <h1>VIEW DEDUCTIONS</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/financials/deductions">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>Deduction ID</th>
                    <th>Deduction Name</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <?php foreach($_SESSION["deductionsList"] as $deduction) { ?>
                        <tr>
                            <td><?= $deduction["deduction_id"] ?></td>
                            <td><?= $deduction["deduction_name"] ?></td>
                            <td><a class="table-btn" href="/admin/financials/deductions/editdeduction/<?= $deduction["deduction_id"] ?>">Edit</a></td>
                            <td><a class="table-btn" href="/admin/financials/deductions/confirmdeletededuction/<?= $deduction["deduction_id"] ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    
    
<?php $this->endSection(); ?>