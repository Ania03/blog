<?php
session_start();
?>

<header class="header">
<meta charset="UTF-8">
  <nav class="nav">
    <div class="logo">
      <ul class="menu__item">
        <li class="menu__list">
          <a href="/index.php">Blog</a>
        </li>
      </ul>
    </div>
    <div class="menu">
      <ul class="menu__item">
        <li class="menu__list">
          <a href="/index.php" class="menu__link">Головна</a>
        </li>
        <?php
        if (isset($_SESSION['id'])) {
          echo '
<li class="menu__list">
  <a href="/profile.php" class="menu__link">Профіль</a>
</li>  <li class="menu__list">
<a href="/addpost.php" class="menu__link">Додати пост</a>
</li> <li class="menu__list">
<a href="/reset-password.php" class="menu__link">Зміна пароля</a>
</li> <li class="menu__list">
<a href="/logout.php" class="menu__link">Вийти</a>
</li>'  ;

        } else {
          echo '
<li class="menu__list">
            <a href="/login.php" class="menu__link">Увійти</a>
          </li>';
        }
        ?>
      
      </ul>
    </div>
  </nav>
</header>