<?php
// セッション開始
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

// データの取得のみ
$sql = "SELECT * FROM message WHERE (m_id = :m_id);";
$stmt = $conn->prepare($sql);
$stmt->bindparam(":m_id", $m_id);
$stmt->execute();
$row = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ゲストブック（詳細表示画面）</title>
</head>

<body>
  <p>詳細表示画面</p>
  <!-- でーたの表示 -->
  <table border="1">
    <tr>
      <td>名前</td>
      <td><?php echo $row["m_name"]; ?></td>
    </tr>
    <tr>
      <td>メールアドレス</td>
      <td><?php echo $row["m_mail"]; ?></td>
    </tr>
    <tr>
      <td>メッセージ</td>
      <td><?php echo nl2br($row["m_message"]); ?></td>
    </tr>
  </table>

</body>

</html>