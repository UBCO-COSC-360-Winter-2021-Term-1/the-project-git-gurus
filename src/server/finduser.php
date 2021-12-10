<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="scripts/validate.js"></script>
    <title>CodeTerra: Find a User</title>
    <?php include 'standardheader.html';?>
  </head>
  <?php include 'navbar.php';?>

  <body>
    <div class="container bg-light">
      <form method="post" action="processfinduser.php" id="mainForm" >
        Username:<br>
        <input type="text" name="username" id="username" class="required">
        <br>
        <br><br>
        <input type="submit" value="Find User">
      </form>
    </div>
  </body>
  <!-- Modal -->
  <?php include 'modal.php';?>
</html>