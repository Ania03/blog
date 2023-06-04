<?php
require_once "db.php";
session_start();

$sql = "SELECT * FROM `posts` ORDER BY `posts`.`id` DESC";
$posts = mysqli_query($connection, $sql);

?>

<style>
  .main {
  margin-top: 20px;
}

.cards {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  list-style: none;
  padding: 0;
}

.cards_item {
  margin: 10px;
}

.card {
  width: 250px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  overflow: hidden;
}


.card_content {
  padding: 20px;
}

.card_top {
  margin-bottom: 10px;
}

.card_title {
  font-size: 18px;
  margin: 0;
}

.card_title a {
  color: #333;
  text-decoration: none;
}

.card_description p {
  margin: 0;
  color: #666;
}
</style>

<div class="main">
  <ul class="cards">
    <?php
    while ($post = $posts->fetch_assoc()) {
    ?>
      <li class="cards_item">
        <div class="card">
     
          <div class="card_content">
            <div class="card_top">
              <h2 class="card_title"><a href="post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a></h2>
            </div>
            <div class="card_description">
              <p><?= $post['description'] ?></p>
            </div>
          </div>
        </div>
      </li>
      <br>
    <?php
    }
    ?>
  </ul>
</div>