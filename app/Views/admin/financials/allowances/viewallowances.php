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
        <h1>VIEW ALLOWANCES</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/financials/allowances">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>Allowance ID</th>
                    <th>Allowance Name</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <?php foreach($_SESSION["allowancesList"] as $allowance) { ?>
                        <tr>
                            <td><?= $allowance["allowance_ID"] ?></td>
                            <td><?= $allowance["allowance_name"] ?></td>
                            <td><a class="table-btn" href="/admin/financials/allowances/editallowance/<?= $allowance["allowance_ID"] ?>">Edit</a></td>
                            <td><a class="table-btn" href="/admin/financials/allowances/confirmdeleteallowance/<?= $allowance["allowance_ID"] ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    
    
<?php $this->endSection(); ?>