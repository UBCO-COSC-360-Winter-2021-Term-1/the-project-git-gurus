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
        <style>
        body {
            background-color: #cccccc;
        }
        </style>
    </head>
    <?php include 'navbar.php';?>
    <body>
        <div class="container bg-light">
            <p class="mr-auto">Welcome to the test site!</p>
            <p class="mr-auto">Check out some of today's hot posts!</p>    

            <div class="d-flex flex-row pt-2">
                <div class="d-flex rounded mr-2" style="height:500px; width:500px;">
                    <div class = "content1" id="content1">
                        <p> This is where content will go </p>
                    </div>
                </div>
                
                <div class="d-flex ml-auto content2 border" id="content2" style="height:500px; width:400px;">
                    <p> This is where content will go </p>
                </div>
            </div>

            <div class="d-flex flex-row">
                <p class="mr-6">Welcome to the test site!</p>
                <div class="d-flex border content3" id="content3" style="height:500px; width:400px;">
                    <p> This is where content will go </p>
                </div>
                <p class="mr-auto"><a href="http://cosc360.ok.ubc.ca/avivarma/secure.php">Secure</a></p>
                <p><a href="http://cosc360.ok.ubc.ca/avivarma/logout.php">Logout</a></p>
            </div>
            
            <script>
                $("#content1").load("processfindposthandler.php?postID=8");
                $("#content2").load("processfindposthandler.php?postID=3");
                $("#content3").load("processfindposthandler.php?postID=34");
            </script>

        </div>
    </body>

    <!-- Modal -->
    <?php include 'modal.php';?>
</html>