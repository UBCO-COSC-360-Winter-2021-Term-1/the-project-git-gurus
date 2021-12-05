<!DOCTYPE html>
<html>

<?php
$validform = 0;
if (!empty($_SERVER['HTTP_REFERER'])) {
    $referredfrom = '<a href="' . $_SERVER['HTTP_REFERER'] . '">Search for another user.</a>';
} else {
    $referredfrom = '<a href="http://cosc360.ok.ubc.ca/avivarma/finduser.php">Search for another user</a>';
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
        echo "no username defined.... <br>";
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
        echo "no username defined.... <br>";
        $validform = 0;
    }
}
?>

<?php
if ($validform == 1) {

    //preprocess user values immediately:
    $username = strtolower($username);

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
            $foundname = $row['username'];
            $firstname = $row['firstName'];
            $lastname = $row['lastName'];
            $email = $row['email'];
            $userID = $row['userID'];
        }
        mysqli_free_result($results);
        mysqli_close($connection);
    }

    if (!empty($foundname)) {
        // echo ("This is a existing username.");
        // echo "<br>";
        //Print the results
        echo ('
        <fieldset id="fieldset" style="width: 300px;">
        <legend>User: '. $foundname . '</legend>
        <table style="text-align: left;">
            <tr">
                <td>First Name:</td>
                <td>'.$firstname.'</td> 
            </tr>
            <tr>
                <td>Last Name:</td>
                <td>'.$lastname.'</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>'.$email.'</td>
            </tr>
            <tr>
                <td>userID:</td>
                <td>'.$userID.'</td>
            </tr>
        </table>
        </fieldset>
        ');
        
        //Get UserImage
        $connection = mysqli_connect($host, $user, $sqlpassword, $database);
        $sql = "SELECT contentType, image FROM userImages where userID=?";
        $stmt = mysqli_stmt_init($connection);
        mysqli_stmt_prepare($stmt, $sql);
         mysqli_stmt_bind_param($stmt, "i", $userID);
        $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
        mysqli_stmt_bind_result($stmt, $type, $image); //bind in results
        mysqli_stmt_fetch($stmt);
        // Fetches the blob and places it in the variable $image for use as well
        // as the image type (which is stored in $type)
        mysqli_stmt_close($stmt);
        
        
        // ready for use in $image
        echo '<img src="data:image/'.$type.';base64,'.base64_encode($image).'"/>';
        echo "<br>";
        echo ($referredfrom);
        echo "<br>";
        
    } else if (empty($foundname)) {
        print_r("Whoops, looks like we can't find a user with that name!");
        echo "<br>";
        echo ($referredfrom);
        echo "<br>";
    }
} else if (!$validform) {
    echo ("Invalid form information, account not created.");
    echo "<br>";
    echo ($referredfrom);
    echo "<br>";
}
?>

</html>