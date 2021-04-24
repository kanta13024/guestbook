<?php
// セッションスタート
session_start();

// 変更内容の取得・検証・加工
$m_name = chkString($_POST["m_name"], "名前");
$m_mail = chkString($_POST["m_mail"],"メールアドレス", true );
$m_message = chkString($_POST["m_message"], "メッセージ", );

// 変更内容をセッション変数に格納
$_SESSION["m_name"] = $m_name;
$_SESSION["m_mail"] = $m_mail;
$_SESSION["m_message"] = $m_message;

// 入力値の検証・加工
function chkString($temp = "", $field, $accept_empty = false)
{
  // 未入力をチェック
  if (empty($temp) and !$accept_empty) {
    echo $field . "にはなにか入力してください";
    exit;
  }
  // 入力内容を安全な値に
  $temp  = htmlspecialchars($temp, ENT_QUOTES, "UTF-8");
  // 加工後の文字を返す
  return $temp;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ゲストブック（変更確認画面）</title>
</head>

<body>
  <p>変更確認画面</p>
  <!-- 変更データの確認フォーム -->
  <form action="update-submit.php" method="POST">
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
        <td><?php echo $m_message; ?></td>
      </tr>
      <tr>
        <td colspan="2">
        <input type="submit" value="変更する">
        </td>
      </tr>
    </table>
  </form>
</body>

</html>