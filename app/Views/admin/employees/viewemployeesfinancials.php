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
        <h1>VIEW EMPLOYEE FINANCIAL DETAILS</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/employees">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>Employee ID</th>
                    <th>First Name</th>
                    <th>Surname</th>
                    <th>Gross Salary</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <?php foreach($_SESSION["financialsList"] as $financial) { ?>
                        <tr>
                            <td><?= $financial["employee_id"] ?></td>
                            <td><?= $financial["firstname"] ?></td>
                            <td><?= $financial["surname"] ?></td>
                            <td><?= $financial["gross_salary"] ?></td>
                            <td><a class="table-btn" href="/admin/employees/editfinancialsmenu/<?= $financial["employee_id"] ?>">View Details</a></td>
                            <td><a class="table-btn" href="/admin/employees/assignmentsmenu/<?= $financial["employee_id"] ?>">Add Assignment</a></td>
                            <td><a class="table-btn" href="/admin/employees/confirmdeleteemployee/<?= $financial["employee_id"] ?>">View Payslip</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    
    
<?php $this->endSection(); ?>