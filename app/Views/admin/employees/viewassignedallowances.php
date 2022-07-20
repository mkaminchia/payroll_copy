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
        <h1>VIEW ASSIGNED ALLOWANCES</h1>
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
                    <th>First Name</th>
                    <th>Surname</th>
                    <th>Allowance</th>
                    <th>Amount</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <?php foreach($_SESSION["employeeAllowancesList"] as $employeeAllowance) { ?>
                        <tr>
                            <td><?= $employeeAllowance["detail_ID"] ?></td>
                            <td>
                                <?php 
                                    foreach($_SESSION["employeesList"] as $employee)
                                    {
                                        if($employee["employee_id"] == $employeeAllowance["employee_id"])
                                        {
                                            echo $employee["firstname"];
                                        }
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    foreach($_SESSION["employeesList"] as $employee)
                                    {
                                        if($employee["employee_id"] == $employeeAllowance["employee_id"])
                                        {
                                            echo $employee["surname"];
                                        }
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    foreach($_SESSION["allowancesList"] as $allowance)
                                    {
                                        if($allowance["allowance_ID"] == $employeeAllowance["allowance_ID"] )
                                        {
                                            echo $allowance["allowance_name"];
                                        }
                                    }
                                ?>
                            </td>
                            <td><?= $employeeAllowance["amount"] ?> KSH</td>
                            <td><a class="table-btn" href="/admin/employees/editassignedallowance/<?= $employeeAllowance["detail_ID"] ?>">Edit</a></td>
                            <td><a class="table-btn" href="/admin/employees/confirmdeleteassignedallowance/<?= $employeeAllowance["employee_id"] ?>/<?= $employeeAllowance["detail_ID"] ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    
    
<?php $this->endSection(); ?>