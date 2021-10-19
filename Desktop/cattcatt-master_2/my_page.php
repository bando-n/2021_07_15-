<?php
session_start();
include('functions.php');
check_session_id();
$pdo = connect_to_db();

$user_id = $_SESSION['id'];
$sql = 'SELECT * FROM todo_table WHERE is_deleted=0 ORDER BY deadline ASC';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();
echo 'マイページ';
// $user_id = $_GET["user_id"];
// $sql = " SELECT users_table(id,usename,password,is_admin,is_deleted,created_at,update_at)VALUES
// (NULL,:user_id,sysdate())";
// $stmt = $pdo->prepare($sql);
// var_dump($_GET);
// exit();

// $stmt->bindValue(':username', $username, PDO::PARAM_INT);
// $status = $stmt->execute();
