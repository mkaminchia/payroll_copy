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
        <h1>VIEW BENEFITS</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/financials/benefits">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>Benefit ID</th>
                    <th>Benefit Name</th>
                    <th>Relief Percentage</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <?php foreach($_SESSION["benefitsList"] as $benefit) { ?>
                        <tr>
                            <td><?= $benefit["benefit_ID"] ?></td>
                            <td><?= $benefit["benefit_name"] ?></td>
                            <td><?= $benefit["relief_percentage"] ?></td>
                            <td><a class="table-btn" href="/admin/financials/benefits/editbenefit/<?= $benefit["benefit_ID"] ?>">Edit</a></td>
                            <td><a class="table-btn" href="/admin/financials/benefits/confirmdeletebenefit/<?= $benefit["benefit_ID"] ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    
    
<?php $this->endSection(); ?>