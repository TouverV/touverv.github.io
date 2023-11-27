<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "UserAuth";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    // die("Connection failed: " . $conn->connect_error);
    die($_SESSION['msg_error'] = "<p>Не удалось подключится к базе данных.<p>" && $_SESSION['msg_error_reg'] = "<p>Не удалось подключится к базе данных.<p>");
}   ?>