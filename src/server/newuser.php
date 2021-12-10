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
</html>