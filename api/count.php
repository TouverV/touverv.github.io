<?php

require_once('db_users.php');
$sql = "SELECT COUNT(*) AS count FROM users";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$totalUsers = $row['count'];

echo '<script>';
echo 'let totalUsers = '.$totalUsers;
echo '</script>';