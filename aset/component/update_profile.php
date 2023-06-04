<?php
require_once "db.php";
session_start();
$id = $_SESSION["id"];
if (!isset($id)) {
  header("location: \login.php");
  return;
}

if (isset($_POST['update'])) {
  $name = $_POST['name'];
  $lastname = $_POST['lastname'];
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $address = $_POST['address'];
  $website = $_POST['website'];

  $sql = "UPDATE `users` SET `name`='$name', lastname='$lastname', age='$age', gender='$gender', address='$address', website='$website' WHERE id=$id";
  mysqli_query($connection, $sql);
  header("location: \index.php");
  return;
}

header("location: profile.php?edit=1");
?>