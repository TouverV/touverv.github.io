<?php 
session_start();
$user = "Регистрация";
$_SESSION['prev_page'] = $_SERVER['REQUEST_URI'];
if (isset($_SESSION['user_name'])) {
  $user = $_SESSION['user_name'];
} else {
  header("Location: auth.php");
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>SAFE-DRIVE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/category_styles.css">
</head>
<body>
    <header class="header">
      <div class='container'>
        <div class="header-nav">
          <div class="logo">SAFE-DRIVE</div>
          <div class="nav-center">
            <a class="nav-item" href="index.php">Главная</a>
            <a class="nav-item" href="index.php#category">Категории</a>
            <a class="nav-item" href="#footer-navid">О нас</a>
          </div>
          <li class="nav-buttons">
            <button type="button" class="theme-button" id="ThemeButtonId">🌑</button>
            <?php
              // Проверка, авторизован ли пользователь
              if (isset($_SESSION['user_name'])) {
                echo '<button type="button" class="user-btn" id="user-btn">' . $user . '</button>';
              } else {
                echo '<button type="button" class="reg-button" onclick="redirectToRegistration()">Регистрация</button>';
              }
            ?>
            <!-- <button type="button" class="reg-button" onclick="location.href='/auth.php';"><?php echo $user ?></button> -->
            <div class="user-menu hidden" id="user-menu">
              <ul>
                <li><a href="#">Профиль</a></li>
                <li><a href="#">Настройки</a></li>
                <li><a href="api/logout.php">Выход</a></li>
              </ul>
            </div>
          </li>
        </div>
      </div>
    </header>
    <main class="main">
      <div class="container">
      <div class="nav-category">
            <a class="nav-item moto" id="btnMoto">Мотоциклы</a>
            <a class="nav-item car" id="btnCar">Легковые</a>
            <a class="nav-item truck" id="btnTruck">Грузовые</a>
          </div>
        <div id="posts-container">
        </div>
      </div>
    </main>
  <footer class="footer">
    <div class='container'>
      <div class="footer-nav" id="footer-navid">
        <div class="ft first"><b>SAFE-DRIVE</b><p>Уверенное вождение начинается с хороших знаний! <br> Черпайте их в наших материалах.</p></div>
        <div class="ft second"><p>О НАС</p><a href="@">Документация</a><a href="@">Lorem.</a><a href="@">GitHub</a></div>
        <div class="ft third"><p>Связь с нами</p><a href="mailto:20voroncov03@gmail.com">Почта</a><a href="https://t.me/touver">Телеграм</a><a href="https://vk.com/touver">ВКонтакте</a></div>
      </div>
    </div>
  </footer>
  <script src="js/lenta.js"></script>
  <script src="js/category.js"></script>
</body>
</html>