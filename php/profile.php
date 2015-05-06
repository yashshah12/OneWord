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
            //DB Credentials
            $host = "host=ec2-23-23-81-221.compute-1.amazonaws.com";
            $port = "port=5432";
            $dbname = "dbname=dfqf1tisgv020h";
            $credentials = "user=aeqorodridmopp password=UdZfcpfn1ViPdEnvoYmug0BAIw";

            $db = pg_connect("$host $port $dbname $credentials");
            if (!$db) {
                echo "Error : Unable to open database\n yash";
            } else {
                echo "Opened database successfully yash \n";
            }

            $temp = $_SESSION['login_user'];

            //Deleting Data that is 1 day old
            $sql = <<<EOF
      DELETE FROM oneword.messages where "LastModified" < NOW() - INTERVAL '1 day';
EOF;
            $ret = pg_query($db, $sql);
            if (!$ret) {
                echo pg_last_error($db);
                exit;
            }
            //$deleteData = "DELETE FROM messages WHERE LastModified < NOW() - INTERVAL '1 day'";

            //VIEW all msgs
            $sql = <<<EOF
      SELECT * from oneword.messages where "ToID" = '$temp';
EOF;
            $ret = pg_query($db, $sql);
            if (!$ret) {
                echo pg_last_error($db);
                exit;
            }

            $rows = pg_num_rows($ret);
            if ($rows > 0) {
                // output data of each row
                $count = 1;
                while ($row = pg_fetch_row($ret)) {
                    // echo $row["Message"]. " From: " . $row["FromID"] ."<br>";

                    $from = $row[1];
                    $message = $row[0];
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
//            echo "Operation done successfully\n";
            pg_close($db);
            ?>
        </div>











    </body>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</html>