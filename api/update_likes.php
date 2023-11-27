<?php
// Получаем данные из тела запроса
$data = json_decode(file_get_contents('php://input'), true);

// Подключение к базе данных
require_once('db_posters.php');

// Получаем идентификатор поста и обновляем количество лайков
$postId = $data['post_id'];
$like = $data['like']; // Новый параметр для обозначения добавления или удаления лайка

// Изменяем количество лайков в базе данных в зависимости от параметра like
if ($like) {
    // Если like === true, увеличиваем количество лайков
    $sql = "UPDATE `Posts` SET `likes` = `likes` + 1 WHERE `Posts`.`id` = $postId;";
} else {
    // Если like === false, уменьшаем количество лайков
    $sql = "UPDATE `Posts` SET `likes` = `likes` - 1 WHERE `Posts`.`id` = $postId;";
}

if ($conn->query($sql) === TRUE) {
    // Получаем новое количество лайков после обновления
    $result = $conn->query("SELECT likes FROM posts WHERE id = $postId");
    $newLikes = $result->fetch_assoc()['likes'];

    // Возвращаем новое количество лайков в формате JSON
    header('Content-Type: application/json');
    echo json_encode(['new_likes' => $newLikes]);
} else {
    // Если произошла ошибка при обновлении лайков
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode(['error' => "Error updating likes: " . $conn->error]);
}

$conn->close();
?>
