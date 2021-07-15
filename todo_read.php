<?php
session_start();
include("functions.php");
check_session_id();

$pdo = connect_to_db();
$user_id = $_SESSION['id'];
$sql = 'SELECT * FROM todo_table
LEFT OUTER JOIN (SELECT todo_id, COUNT(id) AS cnt
FROM like_table GROUP BY todo_id) AS likes
ON todo_table.id = likes.todo_id';

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $output = "";
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td>{$record["deadline"]}</td>";
    $output .= "<td>{$record["todo"]}</td>";
    $output .= "<td>
<a href='like_create.php?user_id={$user_id}&todo_id={$record["id"]}'>
like{$record['cnt']}</a>";
    // 編集ボタン

    $output .= "<td><a href='todo_edit.php?id={$record["id"]}'>edit</a></td>";
    $output .= "<td><a href='todo_delete.php?id={$record["id"]}'>delete</a></td>";
    $output .= "</tr>";
  }
  unset($value);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（一覧画面）</title>
</head>

<body>
  <div class="title_box">
    <h1 class="title_box_title">セカイを変えるGEEKになろう</h1>
    <p class="title_box_text">G's ACADEMY FUKUOKA</p>

  </div>
  <div class="text_box">
    <div>
      <h2 class="title1">CONSEPT</h2>
      <p>最初は全くの初心者でOK！</p>
      <p>まずは純粋にプログラミングを楽しんでいただくことから始めて，最後には現役で活躍する一流エンジニアのメンターサポートをうけながら，オリジナルのWebサービス・アプリを開発〜完成させます．
      </p>
      <p>卒業後の「就職」はもちろん「独立」まで，さまざまなサポート企業やシードアクセラレーターがバックアップ．
      </p>
      <p>さあ，まもなく【GEEK】への扉がひらかれます！
      </p>

    </div>

  </div>

  <div class="image_box">
    <div class="image_box_image">
      <img src="content_img.jpg" alt="">
    </div>
    <div class="image_box_tixt">
      <div>
        <h3>コンセプトはLabo（研究所）</h3>
        <p>制作に没頭するGEEKのための空間を目指しました．電源もたっぷり．Wifiは300台まで同時接続可能．
        </p>
      </div>
    </div>
  </div>

  <fieldset>
    <legend>DB連携型todoリスト（一覧画面）</legend>
    <a href="todo_input.php">入力画面</a>
    <a href="todo_logout.php">logout</a>
    <table>
      <thead>
        <tr>
          <th>deadline</th>
          <th>todo</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>

</body>

</html>