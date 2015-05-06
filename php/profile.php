<?php
//include('session.php');
?>
<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    <head>
        <title>Home</title>
        <link href="../css/homepage.css" rel="stylesheet" type="text/css">
    </head>
    <body>

        <div id = "title-header">
            <h2 class="text-right logout" id="logout"><a href="logout.php">Log Out</a></h2>
            <h1 class ="title">WELCOME:</h1><h1 class = "title-username"><?php echo $_SESSION['login_user']; ?></h1>
        </div>
        <!--Create Message button-->
        <div id = "createmsg">
            <a href="newmessage.php" class="menu">New <span class = "glyphicon glyphicon-plus"></span></a>    
        </div>
        <div class ="inbox"  >
            <h3>INBOX</h3>
            <?php
            $servername = "ec2-23-23-81-221.compute-1.amazonaws.com";
            $username = "aeqorodridmopp";
            $password = "UdZfcpfn1ViPdEnvoYmug0BAIw";
            $dbname = "oneword";

// Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $deleteData = "DELETE FROM messages WHERE LastModified < NOW() - INTERVAL '1 day'";
                    //"DELETE FROM messages WHERE LastModified < NOW() - interval '7 days'";    
                    //. "TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 DAY) )";
            $conn->query($deleteData);
            $temp = $_SESSION['login_user'];
            $sql = "SELECT * FROM messages where ToID = '$temp'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                $count = 1;
                while ($row = $result->fetch_assoc()) {
                    // echo $row["Message"]. " From: " . $row["FromID"] ."<br>";

                    $from = $row["FromID"];
                    $message = $row["Message"];
                    $count++;
                    ?> 

                    <div id = "word1"<?php echo $count ?> class="box effect8">
                        <h3 class="boxh3"><?php echo $from ?></h3>
                        <h1 class="boxh1"><?php echo $message ?></h1>
                    </div>

                    <script>
                        $(document).ready(function () {
                            $('#word1, #word2, #word3').each(function (fadeInDiv) {
                                $(this).delay(fadeInDiv * 500).fadeIn(1000);
                            });
                        });

                        //  $( "#msg" ).fadeIn( 3000 );
                        // $("#msg").fadeOut(3000);
                    </script>  
                    <?php
                    $from = "";
                    $message = "";
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>











    </body>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</html>