<?php 
    $session = session();

    $this->extend('/templates/admin_template');

    $this->section('content');
 
?>

    <script>
        var c = document.getElementById("employees");
        c.className += " active";
    </script>

    <div class="welcome-div">
        <h1>VIEW ASSIGNED BENEFITS</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/employees/editsmenu/<?= $employee_id;?>">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Employee ID</th>
                    <th>Benefit</th>
                    <th>Benefit Amount</th>
                    <th>Relief Amount</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <?php foreach($_SESSION["employeeBenefitsList"] as $employeeBenefit) { ?>
                        <tr>
                            <td><?= $employeeBenefit["detail_ID"] ?></td>
                            <td><?= $employeeBenefit["employee_id"] ?></td>
                            <td>
                                <?php 
                                    foreach($_SESSION["benefitsList"] as $benefit)
                                    {
                                        if($benefit["benefit_ID"] == $employeeBenefit["benefit_ID"] )
                                        {
                                            echo $benefit["benefit_name"];
                                        }
                                    }
                                ?>
                            </td>
                            <td><?= $employeeBenefit["benefit_amount"] ?></td>
                            <td><?= $employeeBenefit["relief_amount"] ?></td>
                            <td><a class="table-btn" href="/admin/employees/editassignedbenefit/<?= $employeeBenefit["detail_ID"] ?>">Edit</a></td>
                            <td><a class="table-btn" href="/admin/employees/confirmdeleteassignedbenefit/<?= $employeeBenefit["employee_id"] ?>/<?= $employeeBenefit["detail_ID"] ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    
    
<?php $this->endSection(); ?>