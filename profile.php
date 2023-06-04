<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog</title>
  <link rel="stylesheet" href="aset/css/style.css">
  <link rel="stylesheet" href="aset/css/header.css">
  <link rel="stylesheet" href="aset/css/footer.css">
  <link rel="stylesheet" href="aset/css/catalog.css">
  <link rel="stylesheet" href="aset/css/post.css">
</head>

<body>
  <div class="wrapper">
    <?php
    include "aset/component/header.php"
    ?>
    <?php
    include "aset/component/profile.php"
    ?>
  </div>
</body>
<script src="https://kit.fontawesome.com/4c32d9a912.js" crossorigin="anonymous"></script>

<script src="aset/js/main.js"></script>

</html>