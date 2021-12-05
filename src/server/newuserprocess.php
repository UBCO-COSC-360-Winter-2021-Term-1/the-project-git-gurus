<!DOCTYPE html>
<html>

<?php
$validform = 0;
if (!empty($_SERVER['HTTP_REFERER'])) {
  $referredfrom = '<a href="' . $_SERVER['HTTP_REFERER'] . '">Return to user entry</a>';
} else {
  $referredfrom = '<a href="http://localhost/lab10/newuser.html">Return to user entry</a>';
}
?>

<!-- GET handler -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $validform = 1;
  //firstname
  if (!empty($_GET["firstname"])) {
    $firstname = $_GET["firstname"];
  } else {
    echo "no firstname defined.... <br>";
    $validform = 0;
  }
  //lastname
  if (!empty($_GET["lastname"])) {
    $lastname = $_GET["lastname"];
  } else {
    echo "no lastname defined.... <br>";
    $validform = 0;
  }
  //username
  if (!empty($_GET["username"])) {
    $username = $_GET["username"];
  } else {
    echo "no username defined.... <br>";
    $validform = 0;
  }
  //email
  if (!empty($_GET["email"])) {
    $email = $_GET["email"];
  } else {
    echo "no email defined.... <br>";
    $validform = 0;
  }
  //password
  if (!empty($_GET["password"])) {
    $password = $_GET["password"];
  } else {
    echo "no password defined.... <br>";
    $validform = 0;
  }
  //password-check
  if (!empty($_GET["password-check"])) {
    $passwordchk = $_GET["password-check"];
  } else {
    echo "no password-check defined.... <br>";
    $validform = 0;
  }
}
?>

<!-- POST handler -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $validform = 1;
  //firstname
  if (!empty($_POST["firstname"])) {
    $firstname = $_POST["firstname"];
  } else {
    echo "no firstname defined.... <br>";
    $validform = 0;
  }
  //lastname
  if (!empty($_POST["lastname"])) {
    $lastname = $_POST["lastname"];
  } else {
    echo "no lastname defined.... <br>";
    $validform = 0;
  }
  //username
  if (!empty($_POST["username"])) {
    $username = $_POST["username"];
  } else {
    echo "no username defined.... <br>";
    $validform = 0;
  }
  //email
  if (!empty($_POST["email"])) {
    $email = $_POST["email"];
  } else {
    echo "no email defined.... <br>";
    $validform = 0;
  }
  //password
  if (!empty($_POST["password"])) {
    $password = $_POST["password"];
  } else {
    echo "no password defined.... <br>";
    $validform = 0;
  }
  //password-check
  if (!empty($_POST["password-check"])) {
    $passwordchk = $_POST["password-check"];
  } else {
    echo "no password-check defined.... <br>";
    $validform = 0;
  }
}
?>

<?php
$firstnames = array();
$lastnames = array();
$usernames = array();
$emails = array();
// $passwords = array();

if ($validform == 1) {
  //preprocess user values immediately:
  $username = strtolower($username);
  $firstname = strtolower($firstname);
  $email = strtolower($email);
  $password = md5($password);
  $passwordchk = md5($passwordchk);

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
    $sql = "SELECT * FROM users WHERE username = '" . $username . "' OR email = '" . $email . "';";
    $results = mysqli_query($connection, $sql);

    //and fetch requsults
    while ($row = mysqli_fetch_assoc($results)) {
      $usernames[] = $row['username'];
      $firstnames[] = $row['firstName'];
      $lastnames[] = $row['lastName'];
      $emails[] = $row['email'];
      // $passwords[] = $row['password'];
    }

    mysqli_free_result($results);
    mysqli_close($connection);
  }


  //Print the results
  if (empty($usernames)) {
    // echo ("This is a new username and email.");
    // echo "<br>";

    //Try to insert into records.
    if (!strcmp($passwordchk, $password)) {
      mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
      $mysqli = new mysqli($host, $user, $sqlpassword, $database);

      if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
      } else {
        //good connection
        $stmt = $mysqli->prepare("INSERT INTO users(username, firstName, lastName, email, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $username, $firstname, $lastname, $email, $password);
        $stmt->execute();

        //cheque please
        // printf("%d row inserted.\n", $stmt->affected_rows);
        // echo "<br>";
        
        //good connection, so do you thing
        $stmt = $mysqli->prepare("SELECT userID FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $result = $stmt->execute();
        $result = $stmt->get_result();

        //and fetch requsults
        if ($result->num_rows === 0) exit('No rows');
        while ($row = $result->fetch_assoc()) {
          $userid = $row['userID'];
        }

        if (!file_exists($_FILES['fileToUpload']['tmp_name']) || !is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
          echo 'No upload';
        } else {
          // $target_dir = "uploads/";
          // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
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
            $sql = "INSERT INTO userImages (userID, contentType, image) VALUES(?,?,?)";
            $connection = mysqli_connect($host, $user, $sqlpassword, $database);
            $stmt = mysqli_stmt_init($connection);
            mysqli_stmt_prepare($stmt, $sql);
            $null = NULL;
            mysqli_stmt_bind_param($stmt, "isb", $userid, $imageFileType, $null);
            mysqli_stmt_send_long_data($stmt, 2, $imagedata);

            $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
            mysqli_stmt_close($stmt);
          }
        }
        
        //If it got here, everything went well.
        echo ("Successfully created account.");
        echo "<br>";
        echo ($referredfrom);
        echo "<br>";
      }
    } else if (strcmp($passwordchk, $password)) {
      echo ("Passwords don't match, try again.");
      echo "<br>";
      echo ($referredfrom);
      echo "<br>";
    }
  } else if (in_array($username, $usernames)) {
    echo ("A user account with this username already exists.");
    echo "<br>";
    echo ($referredfrom);
    echo "<br>";
  } else if (in_array($email, $emails)) {
    echo ("Error: Email has already been used.");
    echo "<br>";
    echo ($referredfrom);
    echo "<br>";
  }
} else if (!$validform) {
  echo ("Invalid form information, account not created.");
  echo "<br>";
  echo ($referredfrom);
  echo "<br>";
}
?>

</html>