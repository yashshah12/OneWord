<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
//$connection = mysql_connect("localhost", "root", "yashshah555");deprecated
    $connection = mysqli_connect("ec2-23-23-81-221.compute-1.amazonaws.com", "aeqorodridmopp", "UdZfcpfn1ViPdEnvoYmug0BAIw", "oneword");
// Selecting Database
//$db = mysql_select_db("login", $connection);
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysqli_query($connection,"select username from users where username='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['username'];
if(!isset($login_session)){
mysqli_close($connection); // Closing Connection
header('Location: index.php'); // Redirecting To Home Page
}
?>