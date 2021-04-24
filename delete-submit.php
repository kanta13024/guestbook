<?php
// セッションの開始
session_start();
if(empty($_SESSION) ) {
  exit;
}

// 接続設定
$dbtype = "mysql";
$sv = "localhost";
$dbname = "guestbook";
$user = "root";
$pass = "root";

// データベースに接続
$dsn = "$dbtype:dbname=$dbname;host=$sv";
$conn = new PDO($dsn, $user, $pass);

// 削除データの主キーを取得
$m_id = $_SESSION["m_id"];

// データを削除
$sql = "DELETE FROM message WHERE (m_id = :m_id);";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":m_id", $m_id);
$stmt->execute();

// エラーチェック
$error = $stmt->errorInfo();
if ($error[0] != "00000") {
  $message = "データの削除に失敗しました{$error[2]}";
}else {
  $message = "データを削除しました";
}

// セッションデータの破棄
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ゲストブック（削除完了画面）</title>
</head>
<body>
<p>削除完了画面</p>
<p><?php echo $message ?></p>
<p><a href="index.php">トップページへ</a></p>
  
</body>
</html>