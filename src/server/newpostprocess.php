<?php
session_start();
$username = $_SESSION["user"];
$validform = 0;
if (!empty($_SERVER['HTTP_REFERER'])) {
  $referredfrom = '<a href="' . $_SERVER['HTTP_REFERER'] . '">Return to user entry</a>';
} else {
  $referredfrom = '<a href="http://cosc360.ok.ubc.ca/avivarma/newpost.php">Return to user entry</a>';
}
?>

<!DOCTYPE html>
<html>

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
echo('Sent info: <br>');
echo('User: ' . $_SESSION["user"] . '<br>');
echo('Post Title: ' .$postTitle . '<br>');
echo('Post Content: ' .$postContent . '<br>');
echo('Valid Form: ' . $validform . '<br>');

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
    echo("userID is " . $userID . '<br><br>');
    
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
      echo "Connected to MySQL";
      //good connection
      $stmt = $mysqli->prepare("INSERT INTO userPosts(userID, postTitle, postContent, postDateTime) VALUES (?, ?, ?, ?)");
      $datetime = '2009-04-30 10:09:00';
      $stmt->bind_param('isss', $userID, $postTitle, $postContent, $datetime);
      $stmt->execute();

      //cheque please
      printf("%d row inserted.\n", $stmt->affected_rows);
      echo "<br>";

      //good connection
      $stmt = $mysqli->prepare("SELECT PostID FROM users WHERE userID = ? ORDER BY PostID DESC LIMIT 1");
      $stmt->bind_param('s', $userID);
      $result = $stmt->execute();
      $result = $stmt->get_result();

      //and fetch requsults
      if ($result->num_rows === 0) exit('No rows');
      while ($row = $result->fetch_assoc()) {
        $postID = $row['postID'];
        echo('postID: ' . $postID . '<br>');
      }

      if (!file_exists($_FILES['fileToUpload']['tmp_name']) || !is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
        echo 'No upload';
      } else {
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
        } else {
          $imagedata = file_get_contents($_FILES['fileToUpload']['tmp_name']);
          $sql = "INSERT INTO postImages (postID, contentType, image) VALUES(?,?,?)";
          $connection = mysqli_connect($host, $user, $sqlpassword, $database);
          $stmt = mysqli_stmt_init($connection);
          mysqli_stmt_prepare($stmt, $sql);
          $null = NULL;
          mysqli_stmt_bind_param($stmt, "isb", $postID, $imageFileType, $null);
          mysqli_stmt_send_long_data($stmt, 2, $imagedata);

          $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
          mysqli_stmt_close($stmt);
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