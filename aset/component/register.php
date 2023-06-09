<?php
require_once "db.php";
if ($_SESSION['loggedin'] === true) {
  header("location: \index.php");
  exit;
}

$email = $password = $confirm_password = $text = "";
$name_err = $password_err = $confirm_password_err = $text_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty(trim($_POST["email"]))) {
    $name_err = "Please enter an email.";
  } else {
    $sql = "SELECT id FROM users WHERE email = ?";

    if ($stmt = $connection->prepare($sql)) {

      $stmt->bind_param("s", $param_name);

      $param_name = trim($_POST["email"]);

      if ($stmt->execute()) {

        $stmt->store_result();

        if ($stmt->num_rows == 1) {
          $name_err = "This email is already taken.";
        } else {
          $email = trim($_POST["email"]);
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      $stmt->close();
    }
  }

  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter a password.";
    echo $password_err;
  } elseif (strlen(trim($_POST["password"])) < 6) {
    $password_err = "Password must have at least 6 characters.";
    echo $password_err;
  } else {
    $password = trim($_POST["password"]);
  }

  if (empty(trim($_POST["confirm_password"]))) {
    $confirm_password_err = "Please confirm password.";
  } else {
    $confirm_password = trim($_POST["confirm_password"]);
    if (empty($password_err) && ($password != $confirm_password)) {
      $confirm_password_err = "Password did not match.";
      echo $confirm_password_err;
    }
  }

  if (empty(trim($_POST["text"]))) {
    $text_err = "Please enter a name.";
    echo $text_err;
  } else {
    $text = trim($_POST["text"]);
  }

  if (empty($name_err) && empty($password_err) && empty($confirm_password_err) && empty($text_err)) {

    $sql = "INSERT INTO users (email, password, name) VALUES (?, ?, ?)";

    if ($stmt = $connection->prepare($sql)) {

      $stmt->bind_param("sss", $param_name, $param_password, $text);

      $param_name = $email;
      $param_password = password_hash($password, PASSWORD_DEFAULT); 

      if ($stmt->execute()) {
        header("location: \login.php");
        exit;
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      $stmt->close();
    }
  }

  $connection->close();
}
?>

