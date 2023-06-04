<?php
require_once "aset/component/db.php";

session_start();

$id = $_SESSION["id"];
if (!isset($id)) {
  header("location: login.php");
  exit;
}?>
<!DOCTYPE html>
<html>

<head>
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
  <title>Create Post</title>
</head>

<body>
  <div class="wrapper">
    <h1>Create Post</h1>
    <form method="post" action="aset/component/addpost.php">
      <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" class="form-control" required><br>
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" class="form-control" required><br>
      </div>
      <div class="form-group">
        <label for="body">Body:</label>
        <textarea id="body" name="body" required class="form-control"></textarea><br>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Add Post">
      </div>
    </form>
  </div>
</body>

</html>