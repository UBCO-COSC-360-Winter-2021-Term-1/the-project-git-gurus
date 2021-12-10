<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $validform = 1;
    //username
    if (!empty($_GET["postID"])) {
        $postID = $_GET["postID"];
    } else {
        echo "no postID defined...";
        $validform = 0;
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validform = 1;
    //username
    if (!empty($_POST["postID"])) {
        $postID = $_POST["postID"];
    } else {
        echo "no postID defined...";
        $validform = 0;
    }
}

if ($validform == 1) {
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
        $sql = "UPDATE userPosts SET postVoteCount = postVoteCount + 1 WHERE postID=?"; // SQL with parameters
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $postID);
        $stmt->execute();
        
        //good connection, so do you thing
        $sql = "SELECT postVoteCount FROM userPosts WHERE postID=?"; // SQL with parameters
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $postID);
        $stmt->execute();
        $results = $stmt->get_result(); // get the mysqli result
        
        //and fetch requsults
        while ($row = mysqli_fetch_assoc($results)) {
            $votecount = $row['postVoteCount'];
        }
        mysqli_free_result($results);
        mysqli_close($connection);
        
        echo($votecount);
    }
} else if (!$validform) {
    echo ("Invalid form.");
}
?>