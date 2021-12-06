<!DOCTYPE html>
<html>
  <head>
    <title>CodeTerra: Login</title>
    <?php include 'standardheader.html';?>
    <!-- Password checking script here!! -->
    <script type="text/javascript" src="js/validate.js"></script>
  </head>


  <body>
    <div class="container">
      <form method="post" action="processlogin.php" id="mainForm" >
        <div class="form-group">
          <input type="text" name="username" id="username" class="form-control required" placeholder="Username">
        </div>
        <div class="form-group">
        <!-- <label for="postTitle">Post Title:</Label> -->
        <input type="text" name="password" id="password" class="form-control required" placeholder="Password">
        </div>  
        <button type="submit" class="btn btn-primary mb-2">Login</button>
      </form>
    </div>
  </body>
</html>