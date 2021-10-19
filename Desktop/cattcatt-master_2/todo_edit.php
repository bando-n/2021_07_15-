<?php
session_start();
include('functions.php');
check_session_id();

$id = $_GET['id'];
$pdo = connect_to_db();
// var_dump($_GET);
// exit();

$sql = 'SELECT * FROM todo_table WHERE id=:id';

// var_dump($_GET);
// exit();

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($_result);
    // exit();
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編集・登録画面</title>
</head>

<body>
    <form action="todo_update.php" method="POST">
        <fieldset>
            <legend>編集・登録画面</legend>
            <a href="todo_txt_read.php">一覧画面</a>
            <div>
                日時: <input type="date" name="deadline" value="<?= $result['deadline'] ?>">
            </div>
            <div>
                名前: <input type="text" name="todo_name" value="<?= $result['todo_name'] ?>">
            </div>
            <div>
                カナ: <input type=" text" name="todo_kana" value="<?= $result['todo_kana'] ?>">
            </div>
            <div>
                年代: <input type=" text" name="age" value="<?= $result['age'] ?>">
            </div>
            <div>
                所属: <input type=" text" name="company" value="<?= $result['company'] ?>">
            </div>
            <div>
                やりたいこと 1: <input type=" text" name="hope" value="<?= $result['hope'] ?>">
            </div>
            <div>
                やりたいこと 2: <input type=" text" name="hope2" value="<?= $result['hope2'] ?>">
            </div>
            <div>
                やりたいこと 3: <input type=" text" name="hope3" value="<?= $result['hope3'] ?>">
            </div>

            <input type="hidden" name="id" value="<?= $result['id'] ?>">
            <div>
                <button><a>公開する</a></button>
            </div>
        </fieldset>
    </form>
</body>

</html>