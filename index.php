<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ゲストブック</title>
</head>

<body>
  <h1>ゲストブック</h1>
  <!-- データの入力フォーム -->
  <form action="confirm.php" method="POST">
    <table border="1">
      <tr>
        <td>お名前：</td>
        <td><input type="text" name="m_name" size="30"></td>
      </tr>
      <tr>
        <td>メールアドレス</td>
        <td><input type="text" name="m_mail" size="30"></td>
      </tr>
      <tr>
        <td>メッセージ</td>
        <td><textarea name="m_message" cols="30" rows="5"></textarea></td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit" value="確認する"></td>
      </tr>
    </table>
  </form>
  <?php
  // 接続設定
  $dbtype = "mysql";
  $sv = "localhost";
  $dbname ="guestbook";
  $user = "root";
  $pass = "root";

  // データベースへの接続
  $dsn = "$dbtype:dbname=$dbname;host=$sv";
  $conn = new PDO($dsn, $user, $pass);

  // データの取得
  $sql = "SELECT * FROM message ORDER BY m_id DESC";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  while ($row = $stmt->fetch() ){
    echo "<hr>{$row["m_id"]}:";
    if (!empty($row["m_mail"]) ) {
      echo "<a href=\"mailto: " . $row["m_mail"] . "\"> " . $row["m_name"] . "</a>";
    }
    else {
      echo $row["m_name"];
    }
    echo "(" . date("Y/m/d H:i" , strtotime($row["m_dt"]) ) . ")" ;
    echo "<p>" . nl2br($row["m_message"]) . "</p>";
    // 変更・削除・詳細画面へのリンク
    echo "<a href=\"update.php?m_id=" .$row["m_id"] ."\">変更</a> "; 
    echo "<a href=\"delete-confirm.php?m_id=" .$row["m_id"] . "\">削除</a> ";
    echo "<a href=\"detail.php?m_id=" . $row["m_id"] . "\">詳細</a>";
  }

  ?>
</body>

</html>