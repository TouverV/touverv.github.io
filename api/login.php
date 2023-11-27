<?php
session_start();
$prev_page = $_SESSION['prev_page'];

require_once('db_users.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $pass = $_POST["pass"];

    // Проверяем, существует ли пользователь с таким логином
    $check_query = "SELECT * FROM users WHERE login='$login'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        // Пользователь существует, проверяем пароль
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row["pass"])) {
            // Пароль верен, устанавливаем сессию и перенаправляем на другую страницу
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_id'] = $row['id'];
            header("Location: $prev_page");
            exit();
        } else {
            $_SESSION['msg_error'] = "<p>Неверный пароль.<p>";
            header("Location: ../auth.php");
        }
    } else {
        $_SESSION['msg_error'] = "<p>Пользователь с таким логином не найден.<p>";
        header("Location: ../auth.php");
    }
}

$conn->close(); // Закрываем соединение с базой данных
?>
