<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="scripts/validate.js"></script>
    <title>CodeTerra: Find a Post</title>
    <?php include 'standardheader.html';?>
    <link rel="stylesheet" href="css/findpost.css">
  </head>
  <?php include 'navbar.php';?>

  <body>
    <div class="container">
      <br>
      <form method="get" action="processfindpostpage.php" id="mainForm" >
        <div class="form-group">
            <input type="text" name="postID" id="postID" class="form-control required" placeholder="Post ID">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Find Post</button>
      </form>
    </div>
  </body>
  <!-- Modal -->
  <?php include 'modal.php';?>
</html>