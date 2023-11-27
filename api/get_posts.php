<?php

// Подключение к базе данных и получение данных о постах
require_once('db_posters.php');

$category = isset($_GET['category']) ? $_GET['category'] : 'all';

$sql = "SELECT posts.id, posts.title, posts.image_url, posts.text, posts.likes, comments.user_name, comments.text AS comment_text
        FROM posts
        LEFT JOIN comments ON posts.id = comments.post_id";

if ($category !== 'all') {
    $sql .= " WHERE posts.category = '$category'";
}

$result = $conn->query($sql);

$posts = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $post_id = $row['id'];

        if (!isset($posts[$post_id])) {
            $posts[$post_id] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'image_url' => $row['image_url'],
                'text' => $row['text'],
                'likes' => $row['likes'],
                'category' => $row['category'],
                'comments' => array()
            );
        }

        if (!empty($row['user_name'])) {
            $posts[$post_id]['comments'][] = array(
                'user_name' => $row['user_name'],
                'text' => $row['comment_text']
            );
        }
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode(array_values($posts));
?>