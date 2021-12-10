<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="scripts/validate.js"></script>
        <title>CodeTerra: Find a User</title>
        <?php include 'standardheader.html';?> 
        <link rel="stylesheet" href="css/processfindpost.css">
        <script>
        function changeContent() {
            if(event.keyCode == 13) {
                let input = document.getElementById('searchbar').value
                input=input.toLowerCase();
                $('#post').load('./processfindposthandler.php?postID=' + input);
            }   
        }
        </script>
    </head>

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
        include 'navbar.php';
        $validform = 0;
    ?>


    <body>
        <div class="container">

        <div class = "d-flex flex-column">    
            <div class="d-flex flex-row">
                <div class="form-outline mt-2">
                    <input id="searchbar" type="search" onkeydown="changeContent()" class="form-control" placeholder="Post ID"/>
                </div>
                <div class="d-flex mt-2" style="width:400px;">
                </div>
            </div>
            <div class="d-flex mt-2 mb-2" id="post">
                <?php include 'processfindposthandler.php';?>
            </div>
            <div class="d-flex mt-2">
            </div>
        </div>
    </body>

    <!-- Modal -->
    <?php include 'modal.php';?>
</html>