<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="scripts/validate.js"></script>
    <title>CodeTerra: Main Page</title>
    <?php include 'standardheader.html';?>
  </head>
  <?php include 'navbar.php';?>

  <body>
    <form method="post" action="processfinduser.php" id="mainForm" >
      Username:<br>
      <input type="text" name="username" id="username" class="required">
      <br>
      <br><br>
      <input type="submit" value="Find User">
    </form>
  </body>
</html>