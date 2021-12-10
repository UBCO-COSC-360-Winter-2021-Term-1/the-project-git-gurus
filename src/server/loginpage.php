<!DOCTYPE html>
<html>
  <head>
    <title>CodeTerra: Login</title>
    <?php include 'standardheader.html';?>
    <!-- Password checking script here!! -->
    <script type="text/javascript" src="js/validate.js"></script>
  </head>

  <?php include("navbar.php"); ?>
  <body>
    <div class="container bg-light pt-4">
      <form method="post" action="processlogin.php" id="mainForm" >
        <div class="form-group">
          <input type="text" name="username" id="username" class="form-control required" placeholder="Username">
        </div>
        <div class="form-group">
        <!-- <label for="postTitle">Post Title:</Label> -->
        <input type="password" name="password" id="password" class="form-control required" placeholder="Password">
        </div>  
        <button type="submit" class="btn btn-primary mb-2">Login</button> <a href="http://cosc360.ok.ubc.ca/avivarma/newuser.php"><button type="button" class="btn btn-primary mb-2">New Account</button><a>
      </form>
    </div>
  </body>
  <?php include("modalform.php"); ?>
</html>