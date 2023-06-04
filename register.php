<?php
require_once "aset/component/db.php";
if ($_SESSION['loggedin'] === true) {
  header("location: index.php");
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
  } elseif (strlen(trim($_POST["password"])) < 6) {
    $password_err = "Password must have at least 6 characters.";
  } else {
    $password = trim($_POST["password"]);
  }

  if (empty(trim($_POST["confirm_password"]))) {
    $confirm_password_err = "Please confirm password.";
  } else {
    $confirm_password = trim($_POST["confirm_password"]);
    if (empty($password_err) && ($password != $confirm_password)) {
      $confirm_password_err = "Password did not match.";
    }
  }

  if (empty(trim($_POST["text"]))) {
    $text_err = "Please enter a name.";
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
        header("location: login.php");
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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      font: 14px sans-serif;
    }

    .wrapper {
      width: 360px;
      padding: 20px;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <h2>Регистрация </h2>
    <p>Введите данные для аккаунта</p>
    <form action="aset/component/register.php"" method="post">
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="text" class="form-control <?php echo (!empty($text_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $text; ?>">
        <span class="invalid-feedback"><?php echo $text_err; ?></span>
      </div>
      <div class="form-group">
        <label>email</label>
        <input type="email" name="email" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
        <span class="invalid-feedback"><?php echo $name_err; ?></span>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
        <span class="invalid-feedback"><?php echo $password_err; ?></span>
      </div>
      <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Submit">

      </div>
      <p>У Вас уже есть аккаунт? <a href="login.php">Авторизация</a>.</p>
    </form>
  </div>
</body>

</html>