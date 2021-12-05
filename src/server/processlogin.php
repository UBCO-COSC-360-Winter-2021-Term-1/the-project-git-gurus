<?php
session_start();
$validform = 0;
?>

<!-- GET handler -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $validform = 1;
    //username
    if (!empty($_GET["username"])) {
        $username = $_GET["username"];
    } else {
        echo "no username defined.... \n";
        $validform = 0;
    }
    //password
    if (!empty($_GET["password"])) {
        $password = $_GET["password"];
    } else {
        echo "no password defined.... \n";
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
        echo "no username defined.... \n";
        $validform = 0;
    }
    //password
    if (!empty($_POST["password"])) {
        $password = $_POST["password"];
    } else {
        echo "no password defined.... \n";
        $validform = 0;
    }
}
?>

<?php


if ($validform == 1) {
    //Preprocess user values immediately:
    $username = strtolower($username);
    $password = md5($password);

    //Establish a connection
    $host = "localhost";
    $database = "db_39738166";
    $user = "39738166";
    $sqlpassword = "39738166";

    $connection = mysqli_connect($host, $user, $sqlpassword, $database);

    $error = mysqli_connect_error();
    if ($error != null) {
        $output = "Unable to connect to database!";
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
        if (!strcmp($password, $passwords)) {
            //cheque please
            $_SESSION["user"] = $username;
            header('location: http://cosc360.ok.ubc.ca/avivarma/home.php');
            
        } else if (strcmp($password, $passwords)) {
            //Invalid password.
            echo ("Username and/or password are invalid.");
        }
    } else if (empty($usernames)) {
        echo ("Username and/or password are invalid.");     
    } 
} else if (!$validform) {
    echo ("Invalid form information, user not logged in.");
} 
?>