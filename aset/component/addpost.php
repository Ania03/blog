<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $user = $_SESSION['id'];
  $title = $_POST["title"];
  $description = $_POST["description"];
  $body = $_POST["body"];

  $sql = "INSERT INTO `posts` (`id`, `user`, `title`, `description`, `body`) VALUES (NULL, ?, ?, ?, ?);";

  if ($stmt = $connection->prepare($sql)) {

    $stmt->bind_param("isss", $user, $title, $description, $body);
    if ($stmt->execute()) {
      $_SESSION['success_message'] = "Blog Post posted successfully!";
      header("location: \index.php");
      exit;
    } else {
      echo "Oops! Something went wrong. Please try again later.";
    }

    $stmt->close();
  }
}
?>

