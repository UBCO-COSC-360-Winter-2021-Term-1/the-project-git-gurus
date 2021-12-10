<!DOCTYPE html>
<html>
<head>
  <title>CodeTerra: Change Password</title>
  <?php include 'standardheader.html';?>
  <!-- Password checking script here! -->
  <script type="text/javascript" src="js/validate.js"></script>
</head>

<body>
  <?php include "navbar.php" ; ?>
<div class="container pt-4">
<form method="post" action="processchangepassword.php" id="mainForm" >
  <div class="form-group">
    <input type="text" name="username" id="username" class="form-control required" placeholder="Username">
  </div>
  <div class="form-group">
    <input type="password" name="oldpassword" id="oldpassword" class="form-control required" placeholder="Old Password">
  </div>
  <div class="form-group">
    <input type="password" name="newpassword" id="password" class="form-control required" placeholder="New Password">
  </div>
  <div class="form-group">
  <input type="password" name="newpassword-check" id="password-check" class="form-control required" placeholder="Re-enter New Password">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Update Password</button>
</form>
</div>
</body>

</html>