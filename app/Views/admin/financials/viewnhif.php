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
        <h1>VIEW NHIF BRACKETS</h1>
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
                    <th>NHIF Amount</th>
                </thead>
                <tbody>
                    <?php foreach($_SESSION["nhifBrackets"] as $nhif) { ?>
                        <tr>
                            <td><?= $nhif["bracket_ID"] ?></td>
                            <td><?= $nhif["cut_off"] ?> KSH</td>
                            <td><?= $nhif["amount"] ?> KSH</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    
    
<?php $this->endSection(); ?>