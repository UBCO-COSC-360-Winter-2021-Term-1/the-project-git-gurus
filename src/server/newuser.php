<!DOCTYPE html>
<html>
<head>
  <title>CodeTerra: New User</title>
  <?php include 'standardheader.html';?>
  <!-- Password checking script here!! -->
  <script type="text/javascript" src="scripts/validate.js"></script>
</head>

  <?php include 'navbar.php';?>
  <body>
    <br>
    <div class="container">
    <form method="post" action="newuserprocess.php" id="mainForm" enctype="multipart/form-data">
      <div class="form-group">
          <input type="text" name="firstname" id="firstname" class="form-control required" placeholder="First Name">
      </div>
      <div class="form-group">
          <input type="text" name="lastname" id="lastname" class="form-control required" placeholder="Last Name">
      </div>
      <div class="form-group">
        <input type="text" name="username" id="username" class="form-control required" placeholder="Username">
      </div>
      <div class="form-group">
          <input type="email" name="email" id="email" class="form-control required" placeholder="name@example.com">
      </div>
      <div class="form-group">
          <input type="password" name="password" id="password" class="form-control required" placeholder="Password">
      </div>
      <div class="form-group">
          <input type="password" name="password-check" id="password-check" class="form-control required" placeholder="Re-enter Password">
      </div>
      
      <div class="form-group">
        <label for="fileToUpload">Profile Photo:  (&lt 64 KB)</label>
        <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
      </div>

      <button type="submit" class="btn btn-primary mb-2">Create New User</button>
    </form>
    </div>
  </body>
  <!-- Modal -->
  <div class="modal fade" id="LogButton" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="LogButtonLabel">User Profile</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <p>login not available on this page.</p>
                  <?php 
                  if(!isset($_SESSION["user"])) {
                      echo('<div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <a href="http://cosc360.ok.ubc.ca/avivarma/newuser.php"><button type="button" class="btn btn-primary">New Account</button><a>
                      <a href="http://cosc360.ok.ubc.ca/avivarma/loginform.php"><button type="button" class="btn btn-primary">Login</button><a>
                      </div>');
                  } else {
                      echo('<p>User signed in is ' . $_SESSION["user"] .' </p>');
                      $_GET['username'] = $_SESSION["user"];
                      include ('processfindusermodal.php');
                      echo('<div class="modal-footer">
                          
                          <a href="http://cosc360.ok.ubc.ca/avivarma/changepasswordpage.php"><button type="button" class="btn btn-primary">Change Password</button><a>
                          <a href="http://cosc360.ok.ubc.ca/avivarma/logout.php"><button type="button" class="btn btn-primary">Log Out</button><a>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>');
                  }
                  ?>
              </div>
              
          </div>
      </div>
  </div>
</html>