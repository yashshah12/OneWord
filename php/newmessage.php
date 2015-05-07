
<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src ="../js/notify.js"></script>

    <head>
        <title>Home</title>
        <link href="../css/newmessage.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h2 class="text-right logout" id="logout"><a href="profile.php">Back</a></h2>
        <div id = "title-header">
            <h1 class ="title">NEW MESSAGE:</h1>
        </div>

        <!-- Testing code to split screen   -->
        <div class="box">

            <div class="div2">
                <h1>Create Message</h1>
            </div>
            <div class="div1">
                <h1>Friends</h1>


            </div>

        </div>

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

        $sql = <<<EOF
      SELECT "UserName" FROM oneword.users where "UserName" <> '$temp';
EOF;
        $ret = pg_query($db, $sql);
        if (!$ret) {
            echo pg_last_error($db);
            exit;
        }

        //$sql = "SELECT Username FROM users where username <> '$temp' ";
        ?>
        <form action="#" method="post">
            <div class="friends">
                <?php
                $rows = pg_num_rows($ret);
                if ($rows > 0) {
                    // output data of each row
                    while ($row = pg_fetch_row($ret)) {
                        // echo $row["Message"]. " From: " . $row["FromID"] ."<br>";
                        $from = $row[0];
                        ?>

                        <div class="div1">
                            <div  id="cblist">
                                <input id="cb1" type="checkbox" name="check_list[]" value="<?php echo $from ?>"  />                
                                <label id='checkboxname' for="cb1"><?php echo $from ?></label>
                            </div>
                        </div>


                        <?php
                    }
                } else {
                    echo "0 results";
                }
                ?>
            </div>
            <div class="div2">
                <div id="create">
                    <input type="messagename" name="wordmessage" placeholder="Enter One Word" id='message' required />
                    <input type="submit"  name="submitmsg" value="Send" id='sendmsg'/>
                    <!--<input type="submit" name="submit" value="Submit"/>-->

                </div>
            </div>
        </form>


        <!--Get info from checked checkbox and insert it into database-->
        <?php
        if (isset($_POST['submitmsg'])) {//to run PHP script on submit
            if (!empty($_POST['check_list'])) {
                $message = $_POST['wordmessage'];
                //echo $message;
                foreach ($_POST['check_list'] as $selected) {
                    //Insert Query
                    $temp = $_SESSION['login_user'];
                    $sql = <<<EOF
      INSERT INTO oneword.messages ("Message","FromID","ToID","LastModified") VALUES('$message', '$temp','$selected',current_timestamp) ;
EOF;
                    $ret = pg_query($db, $sql);
                    
                    // $sql = "INSERT INTO messages (Message,FromID,ToID,LastModified) VALUES ('$message', '$temp','$selected',current_timestamp)";
                    if ($ret) {
                        echo "New record created successfully";
                        ?>
                        <script>
                            $.notify("Sent Successfully");
                        </script>
                        <?php
                    } else if (!$ret) {
                        echo pg_last_error($db);
                        exit;
                    }
                }
            } else {
                echo "<b>Please Select Atleast One Option.</b>";
            }
        }

        $conn->close();
        ?>




    </body>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<!--    <script src ="../js/newmessage.js"></script>-->
</html>