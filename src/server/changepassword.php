<!DOCTYPE html>
<html>
<head>
  <title>CodeTerra: Main Page</title>
  <?php include 'standardheader.html';?>
  <!-- Password checking script here! -->
  <script type="text/javascript" src="js/validate.js"></script>
</head>

<?php include 'navbar.php';?>

<body>

<form method="post" action="processchangepassword.php" id="mainForm" >
  Username:<br>
  <input type="text" name="username" id="username" class="required">
  <br>
  Old Password:<br>
  <input type="password" name="oldpassword" id="oldpassword" class="required">
  <br><br>
  New Password:<br>
  <input type="password" name="newpassword" id="password" class="required">
  <br>
  Re-enter New Password:<br>
  <input type="password" name="newpassword-check" id="password-check" class="required">
  <br><br>
  <input type="submit" value="Update Password">
</form>
</body>
