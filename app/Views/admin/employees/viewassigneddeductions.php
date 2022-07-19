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
        <h1>VIEW ASSIGNED DEDUCTIONS</h1>
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
                    <th>Deduction</th>
                    <th>Amount</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <?php foreach($_SESSION["employeeDeductionsList"] as $employeeDeduction) { ?>
                        <tr>
                            <td><?= $employeeDeduction["detail_ID"] ?></td>
                            <td>
                                <?php 
                                    foreach($_SESSION["employeesList"] as $employee)
                                    {
                                        if($employee["employee_id"] == $employeeDeduction["employee_id"])
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
                                        if($employee["employee_id"] == $employeeDeduction["employee_id"])
                                        {
                                            echo $employee["surname"];
                                        }
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    foreach($_SESSION["deductionsList"] as $deduction)
                                    {
                                        if($deduction["deduction_id"] == $employeeDeduction["deduction_id"] )
                                        {
                                            echo $deduction["deduction_name"];
                                        }
                                    }
                                ?>
                            </td>
                            <td><?= $employeeDeduction["amount"] ?></td>
                            <td><a class="table-btn" href="/admin/employees/editassigneddeduction/<?= $employeeDeduction["detail_ID"] ?>">Edit</a></td>
                            <td><a class="table-btn" href="/admin/employees/confirmdeleteassigneddeduction/<?= $employeeDeduction["employee_id"] ?>/<?= $employeeDeduction["detail_ID"] ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    
    
<?php $this->endSection(); ?>