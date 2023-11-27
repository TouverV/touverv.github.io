<?php 
session_start();
$user = "Регистрация";
$_SESSION['prev_page'] = $_SERVER['REQUEST_URI'];
if (isset($_SESSION['user_name'])) {
  $user = $_SESSION['user_name'];
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>SAFE-DRIVE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
    <?php include 'api/count.php'; ?>
</head>
<body>
    <header class="header">
      <div class='container'>
        <div class="header-nav">
          <div class="logo">SAFE-DRIVE</div>
          <div class="nav-center">
            <a class="nav-item" href="#main-pageid">Главная</a>
            <a class="nav-item" href="#category">Категории</a>
            <a class="nav-item" href="#footer-navid">О нас</a>
          </div>
          <li class="nav-buttons">
            <!-- <button type="button" class="theme-button" id="ThemeButtonId">🌑</button> -->
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
                <li><a href="/api/logout.php">Выход</a></li>
              </ul>
            </div>
          </li>
        </div>
      </div>
    </header>
    <main class="main">
      <div class="container">
        <div class="main-page" id="main-pageid">
          <h1 class="main-text">Управляй мечтой</h1>
          <h2 class="main-subtitle">Освойте вождение любых транспортных средств</h2>
          <button type="button" class="main-button" onclick="location.href='/auth.php';">Записаться</button>
        </div>
        <div class="stat">
          <div class="stat-numbers">
            <p class="stat-text">пользователей уже с нами:</p>
            <p class="stat-users" id="UsersCount"></p>
          </div>
          <div class="stat-info">
            <div class="stat-nav">
              <button class="statbtn moto active">Мотоциклы</button>
              <button class="statbtn car">Легковые</button>
              <button class="statbtn truck">Грузовые</button>
            </div>
            <p id="stat-info-text">Изучите мир мотоциклов и получите навыки, необходимые для безопасного и уверенного управления на двух колесах. Наши курсы помогут вам освоить основные техники вождения, совершенствовать свои навыки и обеспечивать безопасность на дороге.</p>
          </div>
        </div>
        <div class="category" id="category">
          <h1 class="category-text" id="UsersName">категории транспорта</h1>
          <ul class="category-nav">
            <div class="category-moto">
              <div class="img-moto"></div>
              <button type="button" class="btn moto" onclick="navigateToCategory('moto');">+</button>
            </div>
            <div class="category-car">
              <div class="img-car"></div>
              <button type="button" class="btn car" onclick="navigateToCategory('car');">+</button>
            </div>
            <div class="category-truck">
              <div class="img-truck"></div>
              <button type="button" class="btn truck" onclick="navigateToCategory('truck');">+</button>
            </div>
          </ul>
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
  <script>
    let countBlock = document.getElementById("UsersCount");
    countBlock.textContent = totalUsers; 
  </script>
  <script>
    function navigateToCategory(category) {
      window.location.href = `/category.php?category=${category}`;
    }
  </script>
  <script src="js/main.js"></script>
</body>
</html>