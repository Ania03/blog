<?php
require_once "db.php";

session_start();

$id = $_SESSION["id"];
if (!isset($id)) {
  header("location: login.php");
  exit;
}

$sql = "SELECT * FROM `users` WHERE id = {$id}";
$user = mysqli_query($connection, $sql);
$user = $user->fetch_assoc();
?>
<div class="main">
  <?php if (isset($_GET['edit'])): ?>
    <div class="profile">
      <h3>Ваш профиль</h3>
      <?php if (isset($_GET['success'])): ?>
        <div class="success-message">Успешное обновление</div>
      <?php endif; ?>  <br>
      <form action="aset/component/update_profile.php" method="POST">
        <div class="form-group">
          <label for="name">Имя:</label>
          <input type="text" name="name" id="name" value="<?= $user['name'] ?>" required>
        </div>  <br>
        <div class="form-group">
          <label for="lastname">Фамилия:</label>
          <input type="text" name="lastname" id="lastname" value="<?= $user['lastname'] ?>" required>
        </div>  <br>
        <div class="form-group">
          <label for="age">Возраст:</label>
          <input type="text" name="age" id="age" value="<?= $user['age'] ?>" required>
        </div>  <br>
        <div class="form-group">
          <label for="gender">Стать:</label>
          <select name="gender" id="gender" required>
            <option value="Male" <?= ($user['gender'] === 'Male') ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= ($user['gender'] === 'Female') ? 'selected' : '' ?>>Female</option>
            <option value="Other" <?= ($user['gender'] === 'Other') ? 'selected' : '' ?>>Other</option>
          </select>
        </div>  <br>
        <div class="form-group">
          <label for="address">Адрес:</label>
          <input type="text" name="address" id="address" value="<?= $user['address'] ?>" required>
        </div>  <br>
        <div class="form-group">
          <label for="website">Сайт:</label>
          <input type="text" name="website" id="website" value="<?= $user['website'] ?>" required>
        </div>  <br>
        <button type="submit" name="update" class="btn">Update Profile</button>
      </form>
    </div>
  <?php else: ?>
    <div class="post_busk">
      <div class="post__title">
      <h3><?= $user['Name'] ?></h3>
      <br>
        <h3><?= $user['email'] ?></h3>
      </div>
      <a href="profile.php?edit=1" class="edit-link">Нажмите для обновления профиля</a>
    </div>
  <?php endif; ?>
</div>