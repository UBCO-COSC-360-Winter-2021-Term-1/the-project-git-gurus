<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <title>CodeTerra: Main Page</title>

  <link rel="stylesheet" href="./standard.css">
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
      integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
      crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
      integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
      crossorigin="anonymous"></script>
  <!-- Password checking script here!! -->
  <script type="text/javascript" src="scripts/validate.js"></script>
</head>

  <?php include 'navbar.php';?>
  <body>
    <form method="post" action="newuserprocess.php" id="mainForm" enctype="multipart/form-data">
      First Name:<br>
      <input type="text" name="firstname" id="firstname" class="required">
      <br>
      Last Name:<br>
      <input type="text" name="lastname" id="lastname" class="required">
      <br>
      Username:<br>
      <input type="text" name="username" id="username" class="required">
      <br>
      email:<br>
      <input type="text" name="email" id="email" class="required">
      <br>
      Password:<br>
      <input type="password" name="password" id="password" class="required">
      <br>
      Re-enter Password:<br>
      <input type="password" name="password-check" id="password-check" class="required">
      <br>
      File Upload:<br>
      <input type="file" name="fileToUpload" id="fileToUpload">
      <br><br>
      <input type="submit" value="Create New User">
    </form>
  </body>
</html>