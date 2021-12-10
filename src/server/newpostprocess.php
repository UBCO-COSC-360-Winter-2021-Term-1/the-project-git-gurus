<?php
session_start();
$username = $_SESSION["user"];
$validform = 0;
?>

<!-- GET handler -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $validform = 1;
  //postTitle
  if (!empty($_GET["postTitle"])) {
    $postTitle = $_GET["postTitle"];
  } else {
    echo "no postTitle defined.... <br>";
    $validform = 0;
  }
  //postContent
  if (!empty($_GET["postContent"])) {
    $postContent = $_GET["postContent"];
  } else {
    echo "no postContent defined.... <br>";
    $validform = 0;
  }
}
?> 

<!-- POST handler -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $validform = 1;
  //postTitle
  if (!empty($_POST["postTitle"])) {
    $postTitle = $_POST["postTitle"];
  } else {
    echo "no postTitle defined.... <br>";
    $validform = 0;
  }
  //postContent
  if (!empty($_POST["postContent"])) {
    $postContent = $_POST["postContent"];
  } else {
    echo "no postContent defined.... <br>";
    $validform = 0;
  }
}
?> 

<?php

if ($validform == 1) {
  
  //preprocess user values immediately:
  $host = "localhost";
  $database = "db_39738166";
  $user = "39738166";
  $sqlpassword = "39738166";

  $connection = mysqli_connect($host, $user, $sqlpassword, $database);

  $error = mysqli_connect_error();
  if ($error != null) {
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
  } else {
    //good connection, so do you thing
    $sql = "SELECT * FROM users WHERE username = '" . $username . "';";
    $results = mysqli_query($connection, $sql);

    //and fetch requsults
    while ($row = mysqli_fetch_assoc($results)) {
      $userID = $row['userID'];
    }
    mysqli_free_result($results);
    mysqli_close($connection);
  }
  
  if (!empty($userID)) {
    //Try to insert into records.
    $host = "localhost";
    $database = "db_39738166";
    $user = "39738166";
    $sqlpassword = "39738166";
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli($host, $user, $sqlpassword, $database);

    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: " . $mysqli->connect_error;
      exit();
    
    } else {
      //good connection
      $stmt = $mysqli->prepare("INSERT INTO userPosts(userID, postTitle, postContent, postDateTime) VALUES (?, ?, ?, ?)");
      $datetime = date("Y-m-d H:i:s");
      $stmt->bind_param('isss', $userID, $postTitle, $postContent, $datetime);
      $stmt->execute();

      //good connection
      $stmt = $mysqli->prepare("SELECT postID FROM userPosts WHERE userID = ? ORDER BY postID DESC LIMIT 1");
      $stmt->bind_param('i', $userID);
      $result = $stmt->execute();
      $result = $stmt->get_result();

      //and fetch requsults
      if ($result->num_rows === 0) exit('No rows');
      while ($row = $result->fetch_assoc()) {
        $postID = $row['postID'];
        // echo('postID: ' . $postID . '<br>');
      }

      if (!file_exists($_FILES['fileToUpload']['tmp_name']) || !is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
        echo 'No upload ';
      } else {
        $target_dir = ('uploads/');
        $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
        $target_file = $target_dir . "post" . $postID . "." . $imageFileType;
        // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        
        $uploadOk = 1;
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if ($check !== false) {
            // echo "File is an image - " . $check["mime"] . ". ";
            $uploadOk = 1;
          } else {
            // echo "File is not an image. ";
            $uploadOk = 0;
          }
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 10000000) {
          echo "Sorry, your file is too large. ";
          $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "svg") {
          echo "Sorry, only JPG, JPEG, PNG, GIF & SVG files are allowed. ";
          $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded. ";
          // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {            
            $imagedata = file_get_contents($_FILES['fileToUpload']['tmp_name']);
            $sql = "INSERT INTO postImages (postID, contentType, imagePath) VALUES(?,?,?)";
            $connection = mysqli_connect($host, $user, $sqlpassword, $database);
            $stmt = mysqli_stmt_init($connection);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, "iss", $postID, $imageFileType, $target_file);
            $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
            mysqli_stmt_close($stmt);

            echo "File succcessfully uploaded. ";
          } else {
            echo "Sorry, there was an error uploading your file. ";
          }
        }
      }
      
      // If it got here, everything went well.
      echo ("Successfully created post.");
      echo "<br>";
      echo ($referredfrom);
      echo "<br>";
    }
  }
} else if (!$validform) {
    echo ("Invalid form information, post not created.");
    echo "<br>";
    echo ($referredfrom);
    echo "<br>";
}
?>

</html>