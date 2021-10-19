<?php
function connect_to_db()
{
    $dbn = 'mysql:dbname=2a5f436d9652a3c3344f2e0c3322049b;charset=utf8;port=3306;host=mysql-2.mc.lolipop.lan';
    $user = '2a5f436d9652a3c3344f2e0c3322049b';
    $pwd = '0828Bando_bando';
    // データベース接続
    try {
        return new PDO($dbn, $user, $pwd);
    } catch (PDOException $e) {
        echo json_encode(["db error" => "{$e->getMessage()}"]);
        exit();
    }
}
function check_session_id()
{
    if (
        !isset($_SESSION['session_id']) ||
        $_SESSION['session_id'] != session_id()
    ) {
        header('Location: todo_login.php');
    } else {
        session_regenerate_id(true);
        $_SESSION['session_id'] = session_id();
    }
}
