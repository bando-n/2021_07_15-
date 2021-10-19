<?php

// var_dump($_SESSION);
// exit();

session_start();
include('functions.php');
check_session_id();
$pdo = connect_to_db();

$user_id = $_SESSION['id'];
// $sql = 'SELECT * FROM todo_table WHERE is_deleted=0 ORDER BY deadline ASC';
$sql = "SELECT* FROM todo_table LEFT OUTER JOIN(SELECT todo_id,COUNT(id)
AS cnt FROM help_table GROUP BY todo_id) AS likes On todo_table.id=likes.todo_id";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    // データ登録失敗次にエラーを表示 
    exit('sqlError:' . $error[2]);
} else {
    // 登録ページへ移動
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output = '';
    foreach ($result as $record) {
        $output .= "<tr>
        <td>{$record['deadline']}</td>
        <td>{$record['todo_name']}</td>
        <td>{$record['todo_kana']}</td>
        <td>{$record['age']}</td>
        <td>{$record['company']}</td>
        <td>{$record['hope']}</td>
        <td>{$record['hope2']}</td>
        <td>{$record['hope3']}</td><tr>";
        $output .= "<td><a href='help_create.php?user_id={$user_id}&todo_id={$record["id"]}'>協力するよ{$record["cnt"]}</a></td>";
        // $output .= "<td><a href='todo_delete.php?id={$record["id"]}'>削除する</a></td>";
        // $output .= "<td><a href='todo_edit.php?id={$record["id"]}'>更新する</a></td>";
        // $output .= "<td><href='my_page.php?user_id={$user_id}&username={$record["id"]}'></td>";
    }
    //     echo '<pre>';
    //     var_dump($result);
    //     echo '</pre>';
    // exit();
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>公開ページ</title>
</head>

<body>
    <fieldset>
        <legend>公開ページ</legend>
        <p>こんにちは <?= $_SESSION['username'] ?>さん</p>
        <a href="todo_txt_input.php">入力画面</a>
        <a href="todo_logout.php">ログアウト</a>
        <a href="my_page.php?user">マイページ</a>

        <table>
            <thead>
                <tr>
                    <th>日時</th>
                    <th>名前</th>
                    <th>カナ</th>
                    <th>年代</th>
                    <th>所属</th>
                    <th>やりたいこと</th>
                </tr>
            </thead>
            <tbody>
                <?= $output ?>
            </tbody>
        </table>
    </fieldset>
</body>

</html>