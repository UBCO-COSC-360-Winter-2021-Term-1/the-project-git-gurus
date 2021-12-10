<!-- GET handler -->
<?php
$validform = 0;
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

        //good connection, so do you thing
        $sql = "SELECT COUNT(postID) as numposts FROM userPosts WHERE userID=?"; // SQL with parameters
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $results = $stmt->get_result(); // get the mysqli result
        //and fetch requsults
        while ($row = mysqli_fetch_assoc($results)) {
            $numposts = $row['numposts'];
        }
        mysqli_free_result($results);
        mysqli_close($connection);
    }

    if (!empty($foundname)) {
        // echo ("This is a existing username.");
        // echo "<br>";
        //Print the results
        echo ('
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">First Name:</th>
                        <td>'.$firstname.'</td>
                    </tr>
                    <tr>
                        <th scope="row">Last Name:</th>
                        <td>'.$lastname.'</td>
                    </tr>
                    <tr>
                    <th scope="row">Email:</th>
                        <td>'.$email.'</td>
                    </tr>
                    <th scope="row">UserID:</th>
                        <td>'.$userID.'</td>
                    </tr>
                    <th scope="row">Number of User Posts:</th>
                        <td>'.$numposts.'</td>
                    </tr>
                </tbody>
            </table>
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
        
        
        if(!empty($image)) {
            // ready for use in $image
            echo '<img class="m-4 rounded" src="data:image/'.$type.';base64,'.base64_encode($image).'" style="width:400px;"/>';
            echo "<br>";
            echo ($referredfrom);
            echo "<br>";
        } else {
            echo ($referredfrom);
            echo "<br>";
        }
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