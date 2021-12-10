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
        <script>
            function changeContent(arg1) {
                $('#threads').load('./loadthreads.php?category=' + arg1);
            }
            function searchContent(arg1) {
                $('#threads').load('./loadthreadskeyword.php?search=' + arg1);
            }
        </script>
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
    <!-- Footer -->
    <footer class="page-footer bg-light font-small blue pt-4">
        <!-- Footer Links -->
        <div class="container-fluid text-center text-md-left">
            <!-- Grid row -->
            <div class="row">
                <!-- Grid column -->
                <div class="col-md-6 mt-md-0 mt-3">
                <!-- Content -->
                <h5 class="text-uppercase">Footer Content</h5>
                <p>Here you can use rows and columns to organize your footer content.</p>
                </div>
                <!-- Grid column -->
                <hr class="clearfix w-100 d-md-none pb-3">
                    <!-- Grid column -->
                    <div class="col-md-3 mb-md-0 mb-3">
                        <!-- Links -->
                        <h5 class="text-uppercase">Links</h5>
                        <ul class="list-unstyled">
                            <li>
                            <a href="#!">Link 1</a>
                            </li>
                            <li>
                            <a href="#!">Link 2</a>
                            </li>
                            <li>
                            <a href="#!">Link 3</a>
                            </li>
                            <li>
                            <a href="#!">Link 4</a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="col-md-3 mb-md-0 mb-3">
                <!-- Links -->
                <h5 class="text-uppercase">Links</h5>
                <ul class="list-unstyled">
                    <li>
                    <a href="#!">Link 1</a>
                    </li>
                    <li>
                    <a href="#!">Link 2</a>
                    </li>
                    <li>
                    <a href="#!">Link 3</a>
                    </li>
                    <li>
                    <a href="#!">Link 4</a>
                    </li>
                </ul>
                </div>
            </div>
        </div>
        <!-- Footer Links -->
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href="https://www.linkedin.com/in/avivarma/"> Avi Varma</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

    <!-- Modal -->
    <?php include 'modal.php';?>
</html>