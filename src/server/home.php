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
    </head>
    <?php include 'navbar.php';?>
    
    <p>Welcome to the test site!</p>

    <!-- Modal -->
    <?php include 'modal.php';?>

<p><a href="http://cosc360.ok.ubc.ca/avivarma/secure.php">Secure</a></p>
<p><a href="http://cosc360.ok.ubc.ca/avivarma/logout.php">Logout</a></p>

</html>