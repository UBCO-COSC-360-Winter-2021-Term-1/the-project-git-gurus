
<?php
function upVote($postID) {
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
        $sql = "UPDATE userPosts SET postVoteCount = postVoteCount - 1 WHERE postID=?"; // SQL with parameters
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $postID);
        $stmt->execute();
        mysqli_close($connection);
    }
}
?>

<!-- GET handler -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $validform = 1;
    //username
    if (!empty($_GET["postID"])) {
        $postID = $_GET["postID"];
    } else {
        echo "no postID defined.... <br>";
        $validform = 0;
    }
}
?>
<!-- POST handler -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validform = 1;
    //username
    if (!empty($_POST["postID"])) {
        $postID = $_POST["postID"];
    } else {
        echo "no postID defined.... <br>";
        $validform = 0;
    }
}
?>

<?php
if ($validform == 1) {
    upVote($postID);
} else if (!$validform) {
    echo ("Invalid form information, account not created.");
}
?>