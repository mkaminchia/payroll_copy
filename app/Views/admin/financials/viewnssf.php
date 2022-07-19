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
        <h1>VIEW NSSF BRACKETS</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/financials">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Bracket Upper Limit</th>
                    <th>Amount</th>
                </thead>
                <tbody>
                    <?php foreach($_SESSION["nssfBrackets"] as $nssf) { ?>
                        <tr>
                            <td><?= $nssf["bracket_ID"] ?></td>
                            <td><?= $nssf["cut_off"] ?></td>
                            <td><?= $nssf["amount"] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    
    
<?php $this->endSection(); ?>