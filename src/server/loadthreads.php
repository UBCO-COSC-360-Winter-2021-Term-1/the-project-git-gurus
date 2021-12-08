<?php
$validform = 0;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $validform = 1;
    if (!empty($_GET["category"])) {
        // do user authentication as per your requirements
        $category = $_GET['category'];
    } else {
        echo "no category defined....";
        $validform = 0;
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validform = 1;
    if (!empty($_POST["category"])) {
        $category = $_POST["category"];
    } else {
        echo "no category defined....";
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
        if(!strcmp($category,"Popular")) {
            //good connection, so do you thing
            $sql = "SELECT postID FROM userPosts ORDER BY postVoteCount DESC LIMIT 10;"; // SQL with parameters
            $stmt = $connection->prepare($sql);
            // $stmt->bind_param("i", $category);
            $stmt->execute();
            $results = $stmt->get_result(); // get the mysqli result
            //and fetch requsults
            while ($row = mysqli_fetch_assoc($results)) {
                $postIDs[] = $row['postID'];
            }
            mysqli_free_result($results);
            mysqli_close($connection);
        } else if(!strcmp($category,"New")) {
            //good connection, so do you thing
            $sql = "SELECT postID FROM userPosts ORDER BY postDateTime DESC LIMIT 10;"; // SQL with parameters
            $stmt = $connection->prepare($sql);
            // $stmt->bind_param("i", $category);
            $stmt->execute();
            $results = $stmt->get_result(); // get the mysqli result
            //and fetch requsults
            while ($row = mysqli_fetch_assoc($results)) {
                $postIDs[] = $row['postID'];
            }
            mysqli_free_result($results);
            mysqli_close($connection);
        } 
    }
} else if (!$validform) {
    echo ("Invalid form information.");
}





print_r($category);
print_r($postIDs);

echo('<div class="d-flex flex-column mt-2">');
foreach ($postIDs as &$x) {
    echo('
    <div class="d-flex mt-2" id="content' . $x . '" style="height:110px;">
        <p> This is where content will go </p>
    </div>');
    echo('<script>
            $("#content'. $x .'").load("processfindpostpreview.php?postID='. $x .'");
            </script>
        ');
}
echo('</div>')
?>