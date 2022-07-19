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
        <h1>VIEW EMPLOYEE PERSONAL DETAILS</h1>
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
                    <th>Email</th>
                    <th>Age</th>
                    <th>Phone Number</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <?php foreach($_SESSION["employeesList"] as $employee) { ?>
                        <tr>
                            <td><?= $employee["employee_id"] ?></td>
                            <td><?= $employee["firstname"] ?></td>
                            <td><?= $employee["surname"] ?></td>
                            <td><?= $employee["email"] ?></td>
                            <td><?= $employee["age"] ?></td>
                            <td><?= $employee["phone_no"] ?></td>
                            <td><a class="table-btn" href="/admin/employees/editemployeepersonals/<?= $employee["employee_id"] ?>">Edit</a></td>
                            <td><a class="table-btn" href="/admin/employees/confirmdeleteemployee/<?= $employee["employee_id"] ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    
    
<?php $this->endSection(); ?>