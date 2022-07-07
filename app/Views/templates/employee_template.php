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
    <link href="../css/employee.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
</head>
<body>
    <!-- <div class="container-fluid"> -->
        <header class="mb-5">
            <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/employee">Home</a>
                    <a class="navbar-brand" href="#">Payslip</a>
                    <a class="navbar-brand" href="#">Profile</a>
                    <a class="navbar-brand" href="/employee/logout">Logout</a>
                </div>
            </nav>
        </header>


        <?php $this->renderSection('content'); ?>


        <footer class="mb-0 mt-5" style="bottom: 0;" id="footer"> 
            
            <div class="footer-top"> 
                <div class="container"> 
                    <div class="row"> 
                        <div class="col-lg-3 col-md-6 footer-links"> 
                            <h4>Useful Links</h4> 
                            <ul> 
                                <li>
                                    <a href="/">Home</a>
                                </li> 
                                <li>
                                    <a href="/catalogue">Catalogue</a>
                                </li> 
                                <li>
                                    <a href="/auth/login">Login</a>
                                </li> 
                                <li>
                                    <a href="/auth/register">Register</a>
                                </li> 
                                <li>
                                    <a href="#">Back to Top</a>
                                </li> 
                            </ul> 
                        </div> 

                        <div class="col-lg-3 col-md-6 footer-contact"> 
                            <h4>Contact Us</h4> 
                            <p>                                 
                                <strong>Phone:</strong> +254 333 433 333
                                <br> <strong>Email:</strong> ling@fakedomain.com
                                <br> 
                            </p> 
                        </div> 

                        <div class="col-lg-3 col-md-6 footer-info"> 
                            <h3>About LingsCars</h3> 
                            <p>We are a recently founded website that aims to deliver you the car of your dreams at no extra effort.</p> 
                            <div class="social-links mt-3"> 
                                <a href="#" class="twitter">
                                </a> 
                                <a href="#" class="facebook">
                                </a> 
                                <a href="#" class="instagram">
                                </a> 
                                <a href="#" class="linkedin">
                                </a> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div> 
            <div class="container"> 
                <div class="copyright"> &copy; Copyright <strong><span>LingsCars</span></strong>. All Rights Reserved </div> 
                <div class="credits"> Designed by <a href="#">LingsCars</a> </div> 
            </div>
        </footer>    






    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script>
        function search_car() {
            let input = document.getElementById('searchbar').value
            input=input.toLowerCase();
            let x = document.getElementsByClassName('image-and-words');
            
            for (i = 0; i < x.length; i++) { 
                if (!x[i].innerHTML.toLowerCase().includes(input)) {
                    x[i].style.display="none";
                }
                else {
                    x[i].style.display="";                 
                }
            }
        }
    </script>
</body>
</html>