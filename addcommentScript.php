<?php
session_start();
require_once "aset/component/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST["name"];
  $message = $_POST["message"];
  $postID = $_POST["post"];
  $sql = "INSERT INTO `comments` (`name`, `comment`, `post`) VALUES (?, ?, ?)";
  $stmt = $connection->prepare($sql);
  $stmt->bind_param("sss", $name, $message, $postID);
  $stmt->execute();


  if ($stmt->affected_rows > 0) {
    $_SESSION["success_message"] = "Comment added to the Post successfully!";
    header("Location: index.php");
    exit();
  } else {
    $_SESSION["error_message"] = "Failed to add the comment. Please try again.";
    header("Location: index.php");
    exit();
  }
}
?>