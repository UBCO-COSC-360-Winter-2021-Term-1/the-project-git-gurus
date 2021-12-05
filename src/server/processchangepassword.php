<!DOCTYPE html>
<html>

<?php
$validform = 0;
if (!empty($_SERVER['HTTP_REFERER'])) {
    $referredfrom = '<a href="' . $_SERVER['HTTP_REFERER'] . '">Return to user entry</a>';
} else {
    $referredfrom = '<a href="http://cosc360.ok.ubc.ca/avivarma/changepassword.php">Return to user entry</a>';
}
?>



<!-- GET handler -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $validform = 1;
    //username
    if (!empty($_GET["username"])) {
        $username = $_GET["username"];
    } else {
        echo "no username defined... <br>";
        $validform = 0;
    }
    //old password
    if (!empty($_GET["oldpassword"])) {
        $oldpassword = $_GET["oldpassword"];
    } else {
        echo "no old password defined... <br>";
        $validform = 0;
    }
    //new password
    if (!empty($_GET["newpassword"])) {
        $newpassword = $_GET["newpassword"];
    } else {
        echo "no new password defined... <br>";
        $validform = 0;
    }
    //new password check
    if (!empty($_GET["newpassword-check"])) {
        $newpasswordchk = $_GET["newpassword-check"];
    } else {
        echo "no new password check defined... <br>";
        $validform = 0;
    }
}
?>

<!-- POST handler -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validform = 1;
    //username
    if (!empty($_POST["username"])) {
        $username = $_POST["username"];
    } else {
        echo "no username defined... <br>";
        $validform = 0;
    }
    //old password
    if (!empty($_POST["oldpassword"])) {
        $oldpassword = $_POST["oldpassword"];
    } else {
        echo "no oldpassword defined... <br>";
        $validform = 0;
    }
    //new password
    if (!empty($_POST["newpassword"])) {
        $newpassword = $_POST["newpassword"];
    } else {
        echo "no newpassword defined... <br>";
        $validform = 0;
    }
    //new password check
    if (!empty($_POST["newpassword-check"])) {
        $newpasswordchk = $_POST["newpassword-check"];
    } else {
        echo "no new password check defined... <br>";
        $validform = 0;
    }
}
?>

<?php


if ($validform == 1) {
    //Preprocess user values immediately:
    $username = strtolower($username);
    $oldpassword = md5($oldpassword);
    $newpassword = md5($newpassword);
    $newpasswordchk = md5($newpasswordchk);

    //Establish a connection
    $host = "localhost";
    $database = "db_39738166";
    $user = "39738166";
    $sqlpassword = "39738166";

    $connection = mysqli_connect($host, $user, $sqlpassword, $database);

    $error = mysqli_connect_error();
    if ($error != null) {
        $output = "<p>Unable to connect to database!</p>";
        exit($output);
    } else {
        //good connection, so do you thing
        $sql = "SELECT * FROM users WHERE username=?"; // SQL with parameters
        $stmt = $connection->prepare($sql); 
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $results = $stmt->get_result(); // get the mysqli result

        //and fetch requsults
        while ($row = mysqli_fetch_assoc($results)) {
            $usernames = $row['username'];
            $passwords = $row['password'];
        }
        
        mysqli_free_result($results);
        mysqli_close($connection);
    }


    //Print the results
    if (!empty($usernames)) {
        //Password check.
        if (!strcmp($oldpassword, $passwords)) {
            //cheque please
            echo ("User authorized.\n");
            echo "<br>";

            if(!strcmp($newpassword, $newpasswordchk)) {
                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                $mysqli = new mysqli($host, $user, $sqlpassword, $database);

                if ($mysqli->connect_errno) {
                    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                    exit();
                } else {
                    //good connection
                    $stmt = $mysqli->prepare("UPDATE users SET password=? WHERE username=?");
                    $stmt->bind_param('ss', $newpassword, $username);
                    $status = $stmt->execute();
                    if ($status === false) {
                        trigger_error($stmt->error, E_USER_ERROR);
                    }
                    //cheque please
                    //printf("%d row inserted.\n", $stmt->affected_rows);
                    
                    echo("User’s password has been updated");
                    echo "<br>";
                }
            } else if (strcmp($newpassword, $newpasswordchk)) {
                echo "New passwords do not match, try again.";
                echo "<br>";
            }
            echo ($referredfrom);
            echo "<br>";
        } else if (strcmp($oldpassword, $passwords)) {
            //Invalid password.
            echo ("Username and/or password are invalid.");
            echo "<br>";
            echo ($referredfrom);
            echo "<br>";
        }
    } else if (empty($usernames)) {
        echo ("Username and/or password are invalid.");
        echo "<br>";
        echo ($referredfrom);
        echo "<br>";
    } 
} else if (!$validform) {
    echo ("Invalid form information, user not logged in.");
    echo "<br>";
    echo ($referredfrom);
    echo "<br>";
} 

?>

</html>