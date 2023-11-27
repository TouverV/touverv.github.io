<?php
session_start();
// Получение данных из запроса
$data = json_decode(file_get_contents('php://input'), true);

require_once('db_posters.php');

$postId = $data['post_id'];
$user_name = $_SESSION['user_name'];
$text = $data['commentText'];

$sql = "INSERT INTO comments (post_id, user_name, text) VALUES ('$postId', '$user_name', '$text')";

$conn->query($sql);
$conn->close();
?>