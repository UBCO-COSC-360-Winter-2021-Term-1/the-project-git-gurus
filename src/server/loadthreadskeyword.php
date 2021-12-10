<?php
$validform = 0;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $validform = 1;
    if (!empty($_GET["search"])) {
        // do user authentication as per your requirements
        $search = $_GET['search'];
    } else {
        echo "no search defined....";
        $validform = 0;
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validform = 1;
    if (!empty($_POST["search"])) {
        $category = $_POST["search"];
    } else {
        echo "no search defined....";
        $validform = 0;
    } 
} else {
    $postIDs = array(1,2,3,4,5,6);
    // echo json_encode($postIDs);
}

if ($validform == 1) {
    $postIDs = array();

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
        $sql = "SELECT postID, postTitle, postContent FROM userPosts WHERE postTitle LIKE CONCAT('%',?,'%') OR postContent LIKE CONCAT('%',?,'%') ORDER BY postVoteCount DESC LIMIT 10;"; // SQL with parameters
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ss", $search, $search);
        $stmt->execute();
        $results = $stmt->get_result(); // get the mysqli result
        //and fetch requsults
        while ($row = mysqli_fetch_assoc($results)) {
            $postIDs[] = $row['postID'];
        }
        mysqli_free_result($results);
        mysqli_close($connection);
    }
} else if (!$validform) {
    echo ("Invalid form information.");
}

// print_r($search);
// print_r($postIDs);

echo('<div class="d-flex flex-column mt-2">');
foreach ($postIDs as &$x) {
    echo('
    <div class="d-flex bg-light rounded mt-2" id="content' . $x . '" style="">
        <p> This is where content will go </p>
    </div>');
    echo('<script>
            $("#content'. $x .'").load("processfindpostpreview.php?postID='. $x .'");
            </script>
        ');
}
echo('</div>')
?>