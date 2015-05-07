<?php
include('php/login.php'); // Includes Login Script

if (isset($_SESSION['login_user'])) {
    header("location: php/profile.php");
}
?>

<!DOCTYPE html>
<html>

    <head>

        <meta charset="UTF-8">

        <title>OneWord</title>

        <link rel="stylesheet" href="css/loginform.css">

    </head>

    <body> 
        <h1>ONEWORD - ALL IT TAKES IS ONE WORD</h1>
        <div>
            <div id="login-loguout-box">
                <div id="options">
                    <a href="#LogIn"  class="button-login" onclick="displayLogIn()" id="toggle-login">Log in</a>
                    <a href="php/register.php" class="button-register" onclick="displayRegister()"  id="toggle-register">Register</a>

                    <div id="login">
                        <div id="triangle-login"></div>
                        <h1>Log in</h1>
                        <form action="" method="post">
                            <input type="username" name="username" placeholder="UserID" id='username' required/>
                            <input type="password" name="password" placeholder="Password" id='password' required/>
                            <input type="submit" name="submitlogin" value="Log in" />
                            <span id= "errormsg"><?php echo $errorlogin; ?></span>
                        </form>
                    </div>


                </div>
            </div>
        </div>

    </body>
    <script src='https://code.jquery.com/jquery-2.1.3.min.js'></script>

</html>