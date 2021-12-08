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
        /* body {
            background-color: #cccccc;
        } */
        </style>
        <script>
            function changeContent(arg1) {
                $('#threads').load('./loadthreads.php?category=' + arg1);
            }
        </script>
    </head>

    <?php include 'navbar.php';?>
    <body>
        <div class="container bg-light">
            <p class="mr-auto">Welcome to the test site!</p>
            <p class="mr-auto">Check out some of today's hot posts!</p>    
                      
            <div class="container pt-3">
            <select class="form-select" id ="Category" name="category" onmousedown="this.value='';" onchange="changeContent(this.value);">
                    <option value='none' selected>All</option>
                    <option value="Popular">Popular</option>
                    <option value="New">New</option>
                    <!-- <option value='3'>Art History</option>
                    <option value='4'>Biology</option>
                    <option value='5'>Chemistry</option> -->
                </select>       
            </div>

            <div id="threads"></div>

            

        </div>
    </body>

    <!-- Modal -->
    <?php include 'modal.php';?>
</html>