<?php
session_start();
// if(!isset($_SESSION["user"]) ) {
//     header('location: http://cosc360.ok.ubc.ca/avivarma/login.php');
// }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>CodeTerra: Main Page</title>
        <?php include 'standardheader.html';?>
        <script type="text/javascript" src="js/ThreadFunctions.js"></script>
    </head>
    <?php include 'navbarthreads.php';?>
    <body>
        <div class="container bg-light">
            <p class="mr-auto">Welcome to CodeTerra! Check out some of today's hot posts!</p>
            <select class="form-select" id ="Category" name="category" onmousedown="this.value='';" onchange="changeContent(this.value);">
                    <option value='All'>All</option>
                    <option value="Popular" selected>Popular</option>
                    <option value="New">New</option>
            </select>       
            <div id="threads">
                <!-- Default Page Display -->
                <?php
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
                    $postIDs = array();
                    $sql = "SELECT postID FROM userPosts ORDER BY postVoteCount DESC LIMIT 10;"; // SQL with parameters
                    $stmt = $connection->prepare($sql);
                    $stmt->execute();
                    $results = $stmt->get_result(); // get the mysqli result
                    //and fetch requsults
                    while ($row = mysqli_fetch_assoc($results)) {
                        $postIDs[] = $row['postID'];
                    }
                    mysqli_free_result($results);
                    mysqli_close($connection);
                }
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
                </div>
            </div>
        </div>
    </body>
    <?php include 'footer.php';?>

    <!-- Modal -->
    <?php include 'modal.php';?>
</html>