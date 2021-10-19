<?php

session_start();
include('functions.php');
check_session_id();

if (
    !isset($_POST['deadline']) || $_POST['deadline'] == '' ||
    !isset($_POST['todo_name']) || $_POST['todo_name'] == '' ||
    !isset($_POST['todo_kana']) || $_POST['todo_kana'] == '' ||
    !isset($_POST['age']) || $_POST['age'] == '' ||
    !isset($_POST['company']) || $_POST['company'] == '' ||
    !isset($_POST['hope']) || $_POST['hope'] == '' ||
    !isset($_POST['hope2']) || $_POST['hope2'] == '' ||
    !isset($_POST['hope3']) || $_POST['hope3'] == ''

) {

    echo json_encode(["error_msg" => "no input"]);
    exit();
}

$deadline = $_POST['deadline'];
$todo_name = $_POST['todo_name'];
$todo_kana = $_POST['todo_kana'];
$age = $_POST['age'];
$company = $_POST['company'];
$hope = $_POST['hope'];
$hope2 = $_POST['hope2'];
$hope3 = $_POST['hope3'];



$pdo = connect_to_db();

$sql = 'INSERT INTO todo_table(id,deadline,todo_name,todo_kana,age,company,hope,hope2,hope3)
VALUES(NULL,:deadline,:todo_name,:todo_kana,:age,:company,:hope,:hope2,:hope3)';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
$stmt->bindValue(':todo_name', $todo_name, PDO::PARAM_STR);
$stmt->bindValue(':todo_kana', $todo_kana, PDO::PARAM_STR);
$stmt->bindValue(':age', $age, PDO::PARAM_STR);
$stmt->bindValue(':company', $company, PDO::PARAM_STR);
$stmt->bindValue(':hope', $hope, PDO::PARAM_STR);
$stmt->bindValue(':hope2', $hope2, PDO::PARAM_STR);
$stmt->bindValue(':hope3', $hope3, PDO::PARAM_STR);


// var_dump($_POST);
// exit();

$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    // データ登録失敗次にエラーを表示 
    exit('sqlError:' . $error[2]);
} else {
    // 登録ページへ移動
    header('Location:todo_txt_input.php');
}
