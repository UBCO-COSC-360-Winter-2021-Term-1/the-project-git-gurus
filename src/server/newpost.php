<?php
session_start();
if(!isset($_SESSION["user"]) ) {
    header('location: http://cosc360.ok.ubc.ca/avivarma/login.php');
}
?>

<!DOCTYPE html>
<html>

  <head>
    <title>CodeTerra: New Post</title>
    <?php include 'standardheader.html';?>
    <!-- Password checking script here!! -->
    <script type="text/javascript" src="js/validate.js"></script>
  </head>

  <?php include 'navbar.php';?>
  <body>
    <form method="post" action="newpostprocess.php" id="mainForm" enctype="multipart/form-data">
      
      Post Title:<br>
      <input type="text" name="postTitle" id="postTitle" class="required">
      <br>
      
      Post Content:<br>
      <textarea rows="10" cols="30" name="postContent" id="postContent" class="required">Post Content.</textarea>

      <br>
      File Upload:<br>
      <input type="file" name="fileToUpload" id="fileToUpload">
      <br><br>

      <input type="submit" value="Create New User">
    </form>
  </body>
</html>