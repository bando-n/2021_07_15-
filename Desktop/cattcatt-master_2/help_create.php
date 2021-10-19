<?php
session_start();
include('functions.php');
check_session_id();
$pdo = connect_to_db();

$user_id = $_GET["user_id"];
$todo_id = $_GET["todo_id"];

$sql = "SELECT COUNT(*) FROM help_table WHERE user_id=:user_id AND todo_id=:todo_id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':todo_id', $todo_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $like_count = $stmt->fetch();
    // var_dump($like_count[0]);
    // exit();

    if ($like_count[0] != 0) {
        $sql = "DELETE FROM help_table WHERE user_id=:user_id AND todo_id=:todo_id";
    } else {
        $sql = "INSERT INTO help_table(id,user_id,todo_id,created_at) 
        VALUES (NULL,:user_id,:todo_id,sysdate())";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':todo_id', $todo_id, PDO::PARAM_INT);
    $status = $stmt->execute();
    // var_dump($_GET);
    // exit();

    if ($status == false) {
        $error = $stmt->errorInfo();
        echo json_encode(["error_msg" => "{$error[2]}"]);
        exit();
    } else {

        header('Location:todo_txt_read.php');
    }
}
