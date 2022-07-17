<?php $session = session(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Payroll System</title>

    <!--Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
    <!--Fontawesome Icons-->
    <script src="https://kit.fontawesome.com/cf05e83bf0.js" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link href="../css/admin.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
</head>
<body>
    
    <div class="container-fluid" style="padding: 0;">
        <header>
            <div class="topnav" id="myTopnav">
                <a href="/admin" id="home">Home</a>
                <a href="#" id="">Employees</a>
                <a href="#" id="">Benefits</a>
                <a href="#" id="">Allowances</a>
                <a href="#" id="">Deductions</a>
                <a href="/login/logout">Logout</a>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </header>

        <?php $this->renderSection('content'); ?>

        <footer>
            <div class="row footer-top">
                <div class="col-12 col-md-6 footer-links"> 
                    <h4>Useful Links</h4> 
                    <ul> 
                        <li>
                            <a href="/admin">Home</a>
                        </li> 
                        <li>
                            <a href="#">Employees</a>
                        </li> 
                        <li>
                            <a href="#">Benefits</a>
                        </li> 
                        <li>
                            <a href="#">Allowances</a>
                        </li> 
                        <li>
                            <a href="#">Deductions</a>
                        </li> 
                        <li>
                            <a href="/login/logout">Logout</a>
                        </li> 
                        <li>
                            <a href="#">Back to Top</a>
                        </li> 
                    </ul> 
                </div> 
                <hr>
                <div class="col-12 col-md-6 footer-contact"> 
                    <h4>Need help? Contact an admin</h4> 
                    <p>                                 
                        <strong>Phone:</strong> +254 333 433 333
                        <br> <strong>Email:</strong> adminemail@fakedomain.com
                        <br> 
                    </p> 
                </div>
            </div>
            <div class="row footer-bottom">     
                <p class="copyright"> &copy; Copyright <strong><span>C. Czarnikow Sugar (EA) Ltd</span></strong> 2022. All Rights Reserved </p> 
                <p class="credits"> Designed by <a href="#">Michael Development</a> </p>
            </div> 
        </footer>

    </div>


    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script>
        /* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        } 
    </script>

</body>
</html>