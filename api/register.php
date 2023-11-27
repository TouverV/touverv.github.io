<?php

session_start();
require_once('db_users.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $login = $_POST["login"];
    $pass = $_POST["pass"];
    $name = $_POST['name'];

    $errors = array();

    if (!preg_match('/^[А-Яа-яЁё]+$/u', $name) || strpos($name, ' ') !== false) {
        $errors[] = "Недопустимое имя";
    } if (!preg_match('/^[a-zA-Z0-9]+$/', $login)) {
        $errors[] = "Логин введен некорректно";
    } if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{8,}$/', $pass)) {
        $errors[] = "Пароль введен некорректно";
    }

    if (!empty($errors)) {
        $_SESSION['reg_active'] = "true";
        $_SESSION['msg_error_reg'] = "<p>" . implode("</p><p>", $errors) . "</p>";
        header("Location: ../auth.php");
    }   else{
        // Проверяем, существует ли пользователь с таким логином
        $check_query = "SELECT * FROM users WHERE login='$login'";
        $result = $conn->query($check_query);

        if ($result->num_rows > 0) {
            // Пользователь с таким логином уже существует
            $_SESSION['reg_active'] = "true";
            $_SESSION['msg_error_reg'] = "<p>Пользователь с таким логином уже зарегистрирован.<p>";
            header("Location: ../auth.php");
        } else {
            // Хешируем пароль
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
            echo $hashed_password;
            // Добавляем пользователя в базу данных
            $insert_query = "INSERT INTO users (login, pass, name) VALUES ('$login', '$hashed_password', '$name')";

            if ($conn->query($insert_query) === TRUE) {
                header("Location: ../auth.php");
            } else {
                $_SESSION['reg_active'] = "true";
                $_SESSION['msg_error_reg'] = "<p>Ошибка при регистрации: . $conn->error . <p>";
            }
        }
    }
    header("Location: ../auth.php");
}

$conn->close(); // Закрываем соединение с базой данных
?>