<!-- Session Info -->
<?php
    session_start();
    if(isset($_SESSION["user"]) ) {
        header('location: http://cosc360.ok.ubc.ca/avivarma/home.php');
    } else {
        header('location: http://cosc360.ok.ubc.ca/avivarma/loginform.php');
    }   
?>