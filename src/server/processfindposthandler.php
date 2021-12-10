<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="js/validate.js"></script>
        <script type="text/javascript" src="js/upvote.js"></script>
        <title>CodeTerra: Find a Post</title>
        <?php include 'standardheader.html';?>
        <link rel="stylesheet" href="css/vote.css">
    </head>

    
    
    <?php
        $validform = 0;
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

    <body>
        <div class="d-flex flex-row" style="width:100%;">
            <!-- Grab Post -->
            <?php
                if ($validform == 1) {
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
                        $sql = "SELECT * FROM userPosts WHERE postID=?"; // SQL with parameters
                        $stmt = $connection->prepare($sql);
                        $stmt->bind_param("i", $postID);
                        $stmt->execute();
                        $results = $stmt->get_result(); // get the mysqli result
                        //and fetch requsults
                        while ($row = mysqli_fetch_assoc($results)) {
                            $userID = $row['userID'];
                            $postTitle = $row['postTitle'];
                            $postContent = $row['postContent'];
                            $postDateTime = $row['postDateTime'];
                            $postVoteCount = $row['postVoteCount'];
                        }
                        mysqli_free_result($results);

                        //good connection, so do you thing
                        $sql = "SELECT username FROM users WHERE userID=?"; // SQL with parameters
                        $stmt = $connection->prepare($sql);
                        $stmt->bind_param("i", $userID);
                        $stmt->execute();
                        $results = $stmt->get_result(); // get the mysqli result
                        
                        //and fetch requsults
                        while ($row = mysqli_fetch_assoc($results)) {
                            $username = $row['username'];
                        }
                        mysqli_free_result($results);
                        mysqli_close($connection);
                    }
                } else if (!$validform) {
                    echo ("Invalid form information, account not created.");
                    echo "<br>";
                    echo ($referredfrom);
                    echo "<br>";
                }
            ?>
            
            <?php
                //Get UserImage
                $connection = mysqli_connect($host, $user, $sqlpassword, $database);
                $sql = "SELECT imagePath FROM postImages where postID=?";
                $stmt = mysqli_stmt_init($connection);
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_bind_param($stmt, "i", $postID);
                $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
                mysqli_stmt_bind_result($stmt, $imagePath); //bind in results
                mysqli_stmt_fetch($stmt);
                // Fetches the blob and places it in the variable $image for use as well
                // as the image type (which is stored in $type)
                mysqli_stmt_close($stmt);
            ?>
            <?php 
            
            if (!empty($postTitle)) {
                echo('<div class="d-flex flex-column align-items-center rounded-left pt-2" style="background-color:#4b4c4c; width:30px; min-height: 110px">
                    <div id="upvote" onclick="upvote('.$postID.')">
                    </div><br/>
                    <div><h6 id = "votecount'.$postID.'" style="color:white;"> '. $postVoteCount . '</h6></div><br/>
                    <div id="downvote" onclick="downvote('.$postID.')"></div>
                </div>');
                echo('<div class="d-flex flex-column" style="width:100%; min-width:370px;">');
                    echo('<div class="d-flex flex-row rounded-right pt-2" style="background-color:#4b4c4c; width:100%;">');
                        echo ('<div class="ml-1 mr-auto"><a href = "http://cosc360.ok.ubc.ca/avivarma/processfindpostpage.php?postID=' . $postID . '"><h6 style="color:white;">' .$postTitle . '</h6></a></div>');
                        echo ('<div class="mr-2 text-muted">' .$postDateTime . '</div>');
                        echo ('<div class="mr-1 text-muted">' .$username . '</div>');
                    echo('</div>');
                if(!empty($imagePath)) {
                    // ready for use in $image
                    echo('<div class="d-flex justify-content-center align-items-center">
                            <div class="flex-shrink-0 m-2">
                                <img src="'. $imagePath . '" alt="Generic placeholder image" style="height: 300px;"> 
                            </div>                       
                        </div>');
                    echo('<div class="border border-dark pt-2 pl-2 mb-auto" style="min-width:370px; height:100%;">' . $postContent .'</div>');        
                } else {
                    echo('<div class="border border-top-0 border-dark pt-2 pl-2 mb-auto" style="min-width:370px; height:100%;">' . $postContent .'</div>');    
                }
            } else if (empty($postTitle)) {
                echo('<div class="d-flex flex-column align-items-center rounded-left pt-2" style="background-color:#4b4c4c; width:30px; min-height: 110px;">
                    <div id="upvote"></div><br/>
                    <div id = "votecount"><h6 style="color:white;">E</h6></div><br/>
                    <div id="downvote"></div>
                </div>');
                echo('<div class="d-flex flex-column" style="width:100%; min-width:370px;">');
                echo('<div class="d-flex flex-row border-right rounded-right pt-2" style="background-color:#4b4c4c; min-width:370px;">');
                    echo ('<div class="ml-1 mr-auto"><h6 style="color:white;">Error</h6></div>');
                echo('</div>');
                echo('<div class="border pt-2 pl-2 mb-auto" style="min-width:370px; height:100%;"> Whoops, looks like we cant find a post with that id!)</div>');
            }
            ?>

        </div>
    </body>
</html>