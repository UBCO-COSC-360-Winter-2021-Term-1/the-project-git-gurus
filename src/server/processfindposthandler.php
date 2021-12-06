<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="js/validate.js"></script>
        <title>CodeTerra: Find a User</title>
        <?php include 'standardheader.html';?>
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
        <div class="d-flex flex-column">    
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
                $sql = "SELECT contentType, image FROM postImages where postID=?";
                $stmt = mysqli_stmt_init($connection);
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_bind_param($stmt, "i", $postID);
                $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
                mysqli_stmt_bind_result($stmt, $type, $image); //bind in results
                mysqli_stmt_fetch($stmt);
                // Fetches the blob and places it in the variable $image for use as well
                // as the image type (which is stored in $type)
                mysqli_stmt_close($stmt);
            ?>

            <?php 
            if (!empty($postTitle)) {
                echo('<div class="d-flex flex-row border rounded border-dark pt-2" style="background-color:#4b4c4c; min-width:400px;">');
                    echo ('<div class="ml-1 mr-auto"><h6 style="color:white;">' .$postTitle . '</h6></div>');
                    echo ('<div class="mr-2 text-muted">' .$postDateTime . '</div>');
                    echo ('<div class="mr-1 text-muted">' .$username . '</div>');
                echo('</div>');
                if(!empty($image)) {
                    // ready for use in $image
                    echo('<div class="d-flex border justify-content-center align-items-center">
                            <div class="flex-shrink-0">
                                <img src="data:image/'. $type .';base64,'. base64_encode($image) .'" alt="Generic placeholder image" style="height: 300px;"> 
                            </div>                       
                        </div>');
                    echo('<div class="border pt-2 pl-2" style="min-width:400px; min-height:100px;">' . $postContent .'</div>');    
                } else {
                    echo('<div class="border pt-2 pl-2" style="min-width:400px; min-height:100px;">' . $postContent .'</div>');    
                }
            } else if (empty($postTitle)) {
                echo('<div class="d-flex flex-row border rounded border-dark pt-2" style="background-color:#4b4c4c; min-width:400px;">');
                    echo ('<div class="ml-1 mr-auto"><h6 style="color:white;">Error</h6></div>');
                echo('</div>');
                print_r("Whoops, looks like we can't find a post with that id!");

                echo "<br>";
                echo ($referredfrom);
                echo "<br>";
            }
            ?>

        </div>
    </body>
</html>