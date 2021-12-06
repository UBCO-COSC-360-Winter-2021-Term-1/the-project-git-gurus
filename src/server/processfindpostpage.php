<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="scripts/validate.js"></script>
        <title>CodeTerra: Find a User</title>
        <?php include 'standardheader.html';?>
        <link rel="stylesheet" href="css/processfindpost.css">
    </head>

    
    
    <?php
        include 'navbar.php';
        $validform = 0;
        // if (!empty($_SERVER['HTTP_REFERER'])) {
        //     $referredfrom = '<a href="' . $_SERVER['HTTP_REFERER'] . '">Search for another user.</a>';
        // } else {
            
        // }
        $referredfrom = '<a href="http://cosc360.ok.ubc.ca/avivarma/findpost.php">Search for another post</a>';
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
        
        
        <div class="container border rounded">    
        
        
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
            if (!empty($postTitle)) {
                echo('<div class="d-flex flex-row border rounded border-primary">');
                    echo ('<div class="pt-2 pl-2"><h3>' .$postTitle . '</h3></div>');
                    echo ('<div class="pt-2 pl-4 m-2">' .$postDateTime . '</div>');
                    echo ('<div class="p-2 m-2">' .$username . '</div>');
                echo('</div>');
                
                echo('<div class="d-flex flex-column">');
                    echo('<div class="p-2">' . $postContent . '</div>');
                echo('</div>');
                
            } else if (empty($postTitle)) {
                print_r("Whoops, looks like we can't find a post with that id!");
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
                
                
                if(!empty($image)) {
                    // ready for use in $image
                    echo('<div class="d-flex">
                            <div class="flex-shrink-0">
                                <img src="data:image/'. $type .';base64,'. base64_encode($image) .'" alt="Generic placeholder image"> 
                            </div>                           
                        </div>');
                        echo('<div class="flex-grow-1 ms-3">
                        This is some content from a media component. You can replace this with any content and adjust it as needed.
                        </div>');
                        echo('</div>');
                   
                    echo($referredfrom);
                } else {
                    
                }
            ?>
        </div>
    </body>
    <!-- Modal -->
    <?php include 'modal.php';?>

</html>