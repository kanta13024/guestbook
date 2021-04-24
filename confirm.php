<?php
// セッションの開始
session_start();

$m_name = chkString($_POST["m_name"], "名前");
$m_mail = chkString($_POST["m_mail"], "メールアドレス", true);
$m_message = chkString($_POST["m_message"], "メッセージ");


// 入力の取得・検証・加工

$_SESSION["m_name"] = $m_name;
$_SESSION["m_mail"] = $m_mail;
$_SESSION["m_message"] = $m_message;

// 入力の検証・加工
function chkString($temp="", $field, $accept_empty = false){
  // 未入力チェック
  if (empty($temp) AND !$accept_empty) {
    echo "{$field}にはなにか入力してください";
    exit;
  }
  // 入力内容を安全な値に
  $temp = htmlspecialchars($temp, ENT_QUOTES, "UTF-8");

  // 戻り値
  return $temp;
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ゲストブック（追加確認画面）</title>
</head>

<body>
  <p>追加確認画面</p>
  <!-- 入力確認用画面 -->
  <form action="submit.php" method="POST">
    <table border="1"> 
    <tr>
      <td>お名前</td>
      <td><?php echo $m_name ?></td>
    </tr>
    <tr>
      <td>メールアドレス</td>
      <td><?php echo $m_mail ?></td>
    </tr>
    <tr>
      <td>メッセージ</td>
      <td><?php echo nl2br($m_message); ?></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" value="書き込み"></td>
    </tr>
    </table>
  </form>


</body>

</html>