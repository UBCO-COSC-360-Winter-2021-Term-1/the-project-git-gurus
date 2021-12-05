<nav class="navbar navbar-expand-lg navbar-light bg-light">
    
        <a href="index.jsp" class="navbar-left"><img src="img/Logo.png" width="35 px" height="41 px" style="border-radius: 90%;"></a>
    
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
    
                <li class="nav-item active">
                    <a class="nav-link" href="./home.php">Home <span class="sr-only">(current)</span></a>
                </li>
    
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Top Links
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="./newuser.php">New User</a>    
                        <a class="dropdown-item" href="./finduser.php">Find Users</a>
                        <a class="dropdown-item" href="./changepassword.php">Change Password</a>
                        <a class="dropdown-item" href="./newpost.php">New Post</a>
                    </div>
                </li>
            </ul>
    
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
    
            <!-- Trigger the modal with a button -->
            <button type="button" class="btn btn-info btn-md little-margin-left" data-toggle="modal" data-target="#LogButton">
            <?php
                if(isset($_SESSION["user"]) ) {
                    echo($_SESSION["user"]);
                } else {
                    echo('Log In');
                }
            ?>
            </button>
        </div>
    </nav>