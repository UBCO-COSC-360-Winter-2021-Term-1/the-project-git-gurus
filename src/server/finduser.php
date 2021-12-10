<!DOCTYPE html>
<html>
  <head>
    <?php include 'standardheader.html';?>  
    <script type="text/javascript" src="scripts/validate.js"></script>
    <title>CodeTerra: Find a User</title>
  </head>
  <?php include 'navbar.php';?>

  <body>
    <div class="container pt-4">
      <form method="post" action="processfinduser.php" id="mainForm">
        <div class="form-group">
          <input type="text" name="username" id="username" class="form-control required" placeholder="Username">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Find User</button>
      </form>
    </div>
  </body>
  <!-- Modal -->
  <?php include 'modalform.php';?>
  
  
</html>