<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll System</title>

    <!--CSS-->
    <link rel="stylesheet" href="../css/login.css">

    <!--Fontawesome Icons-->
    <script src="https://kit.fontawesome.com/cf05e83bf0.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">
        <div class="wall">
            <h1 class="home-button"><a href="/">C.Czarnikow Sugar (EA) Ltd.</a></h1>
            <h1 class="message">Payroll system</h1>
        </div>
        <div class="form">
            <h1>Login Form</h1>
            <form id="loginForm" method="post" action="/employee/processlogin">
                <div class="input-div">
                    <i id="user-icon" class="fas fa-envelope"></i>  
                    <input class="input" type="email" name="email" id="email" placeholder="E-mail*" required> 
                </div>
                <div class="input-div">
                    <i id="password-icon" class="fas fa-lock"></i>  
                    <input class="input" type="password" name="password" id="password" placeholder="Password*">                
                </div>
                <button class="cta" type="submit" name="login">LOG IN</button>
            </form>
            <a href="#">Forgot password</a>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script type = "text/javascript" src = "../js/scripts.js"></script>
    
</body>
</html>