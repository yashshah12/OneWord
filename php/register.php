<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>

<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>OneWord</title>

    <link rel="stylesheet" href="../css/register.css">

</head>

<body> 
<div>
     <div id="login-loguout-box">
  <div id="options">
  <a href="../index.php"  class="button-login" onclick="displayLogIn()" id="toggle-login">Log in</a>
  <a href="#register" class="button-register" onclick="displayRegister()"  id="toggle-register">Register</a>
 

<div id="register">
  <div id="triangle-register"></div>
  <h1>Register</h1>
  <form action="" method="post">
    <input type="username" name="username" placeholder="UserID" id='username2'  required/>
    <input type="password" name="password" placeholder="Password" id='password2' required/>
    <input type="password" name="passwordAgain" placeholder="Password Again" id='passwordAgain' required/>
    <input type="submit" name="submitregister" value="Register" />
    <span id= "errormsg"><?php echo $errorregister;?></span>
  </form>
    
</div>
      
 </div>
</div>
</div>

</body>
    <script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>

</html>