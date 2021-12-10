<!DOCTYPE html>
<html>
<head>
  <title>CodeTerra: Change Password</title>
  <script type="text/javascript" src="js/validate.js"></script>
</head>

<body>
<div class="container">
<form method="get" action="processfindpostpage.php" id="mainForm" >
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
</div>
</body>

</html>