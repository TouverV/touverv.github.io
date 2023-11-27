<?php 
session_start();
if ($_SESSION['reg_active'] == "true"){
  $reg_active = "active";
  unset($_SESSION['reg_active']);
}
if (isset($_SESSION['user_id'])){
  header("Location: index.php");
}
if (isset($_SESSION['msg_error'])){
  $msg_error = $_SESSION['msg_error'];
  unset($_SESSION['msg_error']);
}
if (isset($_SESSION['msg_error_reg'])){
  $msg_error_reg = $_SESSION['msg_error_reg'];
  unset($_SESSION['msg_error_reg']);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>SAFE-DRIVE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/auth.css">
</head>
<body>
    <main class="main">
      <div class="container">
          <div class="modal-content <?= $reg_active; ?>">
              <!-- Форма входа -->
              <form class="login" action="api/login.php" method="post">
                  <div class="content">          
                    <h2>Вход</h2>      
                    <div class="form">          
                      <div class="inputBox">          
                        <input type="text" name="login" required> <i>Логин</i>          
                      </div>          
                      <div class="inputBox">          
                        <input type="password" name="pass" required> <i>Пароль</i>          
                      </div>          
                      <div class="links"> <a href="index.php">На главную</a> <a href="#" class="signup-link">Регистрация</a>          
                      </div>
                      <?php echo $msg_error ?>        
                      <div class="inputBox">          
                        <input type="submit" value="Войти" style="font-family: 'Bebas Neue', sans-serif;">          
                      </div>          
                    </div>         
                  </div> 
                </form> 
                <!-- Форма регистрации -->
              <form class="signup" action="api/register.php" method="post">        
                <div class="content">          
                  <h2>Регистрация</h2>          
                   <div class="form">
                     <div class="inputBox">          
                       <input type="text" name="name" required> <i>Имя</i>          
                      </div>                    
                      <div class="inputBox">          
                        <input type="text" name="login" required> <i>Логин</i>          
                      </div>          
                      <div class="inputBox">          
                        <input type="password" name="pass" required> <i>Пароль</i>          
                      </div>
                      <div class="links"> <a href="#" class="login-link">Вход</a> <a href="index.php">На главную</a>          
                      </div>
                      <?php echo $msg_error_reg ?>                    
                      <div class="inputBox">          
                        <input type="submit" value="Зарегистрироваться" style="font-family: 'Bebas Neue', sans-serif;">          
                      </div>          
                  </div>   
                </div> 
              </form>
            </div>
      </div>
    </main>
  <script src="js/auth.js"></script>
</body>
</html>