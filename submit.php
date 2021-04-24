<?php
// セッションの開始
session_start();
if (empty($_SESSION)) {
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

// 入力内容の取得($_SESSIONから)
$m_name = htmlspecialchars($_SESSION["m_name"], ENT_QUOTES, "UTF-8");
$m_mail = htmlspecialchars($_SESSION["m_mail"], ENT_QUOTES, 'UTF-8');
$m_message = htmlspecialchars($_SESSION["m_message"], ENT_QUOTES, 'UTF-8');

// データの追加
$sql = "INSERT INTO message(m_name, m_mail, m_message, m_dt) VALUES(:m_name, :m_mail, :m_message, NOW() )";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":m_name", $m_name);
$stmt->bindParam(":m_mail", $m_mail);
$stmt->bindParam(":m_message", $m_message);
$stmt->execute();

// エラーチェック
$error = $stmt->errorInfo();
if ($error[0] != "00000") {
  $message = "データの追加に失敗しました{$error[2]}";
} else {
  $message = "データを追加しました・データ番号:" . $conn->lastInsertId();
}

// セッションデータの廃棄
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ゲストブック（追加完了画面）</title>
</head>

<body>
  <p>追加完了画面</p>
  <p><?php echo $message ?></p>
  <table border="1">
  <tr>
    <td>名前</td>
    <td><?php echo $m_name; ?></td>
  </tr>
  <tr>
    <td>メールアドレス</td>
    <td><?php echo $m_mail; ?></td>
  </tr>
  <tr>
    <td>メッセージ</td>
    <td><?php echo nl2br($m_message); ?></td>
  </tr>
  </table>
  <p><a href="index.php">トップページへ</a></p>
</body>

</html>