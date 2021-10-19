<?php
session_start();
include('functions.php');
check_session_id();
$user_id = $_SESSION['id'];
// var_dump($user_id);
// exit();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編集・登録画面</title>
</head>

<body>
    <form action="todo_txt_create.php" method="POST">
        <fieldset>
            <legend>編集・登録画面</legend>
            <p>こんにちは <?= $_SESSION['username'] ?>さん</p>

            <a href="todo_txt_read.php">一覧画面</a>
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
            <div>
                日時: <input type="date" name="deadline">
            </div>
            <div>
                名前: <input type="text" name="todo_name">
            </div>
            <div>
                カナ: <input type="text" name="todo_kana">
            </div>
            <div>
                年代: <input type="text" name="age">
            </div>
            <div>
                所属: <input type="text" name="company">
            </div>
            <div>
                やりたいこと 1: <input type="text" name="hope">
            </div>
            <div>
                やりたいこと 2: <input type="text" name="hope2">
            </div>
            <div>
                やりたいこと 3: <input type="text" name="hope3">
            </div>
            <div>
                <button><a>公開する</a></button>
            </div>
        </fieldset>
    </form>
</body>

</html>