<?php
require_once "db.php";

$id = $_GET["id"];
$sql = "SELECT * FROM `posts` WHERE id = {$id}";
$post = mysqli_query($connection, $sql);
$post = $post->fetch_assoc();

$sql = "SELECT * FROM `comments` WHERE post = {$id}";
$comments = mysqli_query($connection, $sql);

?>
<style>
  .main {
    width: 800px;
    margin: 0 auto;
  }

  .post_busk {
    background-color: #f5f5f5;
    padding: 20px;
    margin-bottom: 20px;
  }

  .post__title {
    font-size: 24px;
    margin-bottom: 10px;
  }



  .post__info {
    margin-top: 20px;
  }

  .post__info p {
    margin-bottom: 10px;
  }

  .post__info h4 {
    margin-top: 20px;
    margin-bottom: 10px;
  }

  .post__info form {
    margin-top: 20px;
  }

  .post__info input,
  .post__info textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    resize: vertical;
  }

  .post__info button {
    padding: 10px 20px;
    background-color: #337ab7;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .post__info button:hover {
    background-color: #286090;
  }
</style>

<div class="main">
  <div class="post_busk">
    <div class="post__title">
      <h1><?= $post['title'] ?></h1>
    </div>
    <div class="post__title">
      <h3><?= $post['description'] ?></h3>
    </div>
    <div class="post__title">
      <h5><?= $post['body'] ?></h5>
    </div>

    <div class="post__info">

      <h4>Коментарі</h4>
      <?php
      while ($comment = $comments->fetch_assoc()) {
      ?>
       <h2><?= $comment['name'] ?></h2>
        <p><?= $comment['comment'] ?></p>
        <br>
      <?php
      }
      ?>

      <form action="/addcommentScript.php" method="post">
        <input type="text" name="name" placeholder="Your Name" required>
        <textarea name="message" placeholder="Your Comment" required></textarea>
        <input type="hidden" name="post" value="<?= $post['id'] ?>">
        <button type="submit">Add Comment</button>
      </form>
    </div>
  </div>
</div>