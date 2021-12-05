<!DOCTYPE html>
<html>
  <head>
    <title>CodeTerra: Main Page</title>
    <?php include 'standardheader.html';?>
    <!-- Password checking script here!! -->
    <script type="text/javascript" src="js/validate.js"></script>
  </head>
  <!-- Let's not bother with a navbar as we'll be accessing this from our modal. -->
  <?php //include 'navbar.php';?>

  <body>

  <form method="post" action="processlogin.php" id="mainForm" >
    Username:<br>
    <input type="text" name="username" id="username" class="required">
    <br>
    Password:<br>
    <input type="password" name="password" id="password" class="required">
    <br>
    <br><br>
    <input type="submit" value="Login">
  </form>
  </body>
</html>