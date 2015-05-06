<?php
session_start(); // Starting Session
$errorlogin = ''; // Variable To Store Error Message
$errorregister = ''; //Variable to Store Error Message
if (isset($_POST['submitlogin'])) {
// Define $username and $password
    $username = $_POST['username'];
    $password = $_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter

    $connection = mysqli_connect("ec2-23-23-81-221.compute-1.amazonaws.com", "aeqorodridmopp", "UdZfcpfn1ViPdEnvoYmug0BAIw", "oneword");
// Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
//$connection = mysql_connect("localhost", "root", "yashshah555");Deprecated
// To protect MySQL injection for Security purpose
    $username = stripslashes($username);
    $password = stripslashes($password);
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
// Selecting Database
//$db = mysql_select_db("login", $connection);Deprecated
//if(!$db) {
//     echo("no database!\n");
//    exit();
//}
// SQL query to fetch information of registerd users and finds user match.
    $query = mysqli_query($connection, "select * from users where password='$password' AND username='$username'");
    $rows = mysqli_num_rows($query);
    if ($rows == 1) {
        $_SESSION['login_user'] = $username; // Initializing Session
        header("location: profile.php"); // Redirecting To Other Page
    } else {
        $errorlogin = "Username or Password is invalid";
    }
    mysqli_close($connection); // Closing Connection
}

//for register button - add a new entry to database
else if (isset($_POST['submitregister'])) {
    if ($_POST['password'] != $_POST['passwordAgain']) {
        $errorregister = "Passwords does not match";
        ?><script>
            $('#login').hide();
            $('#register').show();
        </script>
        <?php
    } else {
// Define $username and $password
        $username = $_POST['username'];
        $password = $_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
        $connection = mysqli_connect("ec2-23-23-81-221.compute-1.amazonaws.com", "aeqorodridmopp", "UdZfcpfn1ViPdEnvoYmug0BAIw", "oneword");
// Check connection
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
//  echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
//// To protect MySQL injection for Security purpose
//$username = stripslashes($username);
//$password = stripslashes($password);
//$username = mysqli_real_escape_string($connection,$username);
//$password = mysqli_real_escape_string($connection,$password);
        //Insert Query
        $sql = "INSERT INTO users (UserName, Password)
VALUES ('$username', '$password')";
        if (mysqli_query($connection, $sql)) {
            echo "New record created successfully";

            $_SESSION['login_user'] = $username; // Initializing Session
            header("location: profile.php"); // Redirecting To Other Page
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
        mysqli_close($connection); // Closing Connection}
    }
}
?>