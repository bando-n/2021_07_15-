<?php
session_start();
include('functions.php');
check_session_id();
$pdo = connect_to_db();

$id = $_GET['id'];

// $sql = 'DELETE FROM todo_table WHERE id=:id';
$sql = 'UPDATE todo_table SET is_deleted=1 WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
// var_dump($_GET);
// exit();

$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    header('Location:todo_txt_read.php');
    exit();
}
