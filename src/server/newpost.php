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
    <link rel="stylesheet" href="css/submitpost.css">
  </head>

  <?php include 'navbar.php';?>
  <body>
  <div class="container">  
  <form method="post" action="newpostprocess.php" id="mainForm" enctype="multipart/form-data">
      <br>
      <div class="form-group">
        <!-- <label for="postTitle">Post Title:</Label> -->
        <input type="text" name="postTitle" id="postTitle" class="form-control required" placeholder="Post Title">
      </div>
      
      <div class="form-group">
      <textarea rows="10" cols="30" name="postContent" id="postContent" class="form-control required" placeholder="Post Content"></textarea>
      </div>

      <div class="form-group">
        <label for="fileToUpload">File input:  (&lt 64 KB)</label>
        <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
      </div>
      
      <button type="submit" class="btn btn-primary mb-2">Create New Post</button>
    </form>
  </div>
  </body>    
  <!-- Modal -->
    <?php include 'modal.php';?>
</html>