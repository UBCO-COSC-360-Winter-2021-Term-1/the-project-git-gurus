<?php
session_start();
// if(!isset($_SESSION["user"]) ) {
//     header('location: http://cosc360.ok.ubc.ca/avivarma/login.php');
// }
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $initialsearch = 1;
    if (!empty($_GET["keyword"])) {
        // do user authentication as per your requirements
        $keyword = $_GET['keyword'];
    } else {
        $initialsearch = 0;
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $initialsearch = 1;
    if (!empty($_POST["keyword"])) {
        $keyword = $_POST["keyword"];
    } else {
        $initialsearch = 0;
    } 
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>CodeTerra: Search for Posts</title>
        <?php include 'standardheader.html';?>
        <script>
            function searchContent(arg1) {
                $('#threads').load('./loadthreadskeyword.php?search=' + arg1);
            }
            <?php
            if($initialsearch == 1) {
                echo("$(document).ready(function() {
                    $('#threads').load('./loadthreadskeyword.php?search=".$keyword."');
                });");
            }
            ?>
        </script>
    </head>

    <?php include 'navbarthreads.php';?>
    <body>
        <div class="container bg-light">
            <p class="mr-auto">We found the following posts:</p>
            <div id="threads">
            </div>
        </div>
    </body>

    <!-- Modal -->
    <?php include 'modal.php';?>

</html>