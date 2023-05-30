<?php

require_once '../classes/UserLogic.php';

$err = [];

// バリデーションチェック
if(!$username = filter_input(INPUT_POST, 'username')) { //name属性がpostかを確認する
    $err[] = 'ユーザ名を記入してください';
} 
if(!$email = filter_input(INPUT_POST, 'email')) { 
    $err[] = 'メールアドレスを記入してください';
} 
$password = filter_input(INPUT_POST, 'password');
// 正規表現
if (!preg_match("/\A[a-z\d]{8,100}+\z/i",$password)) {
    $err[] = 'パスワードは英数字8文字以上100文字以下にしてください';
}
$password_conf = filter_input(INPUT_POST,'password_conf');
if ($password !== $password_conf) {
    $err[] = '確認用パスワードと異なっています';
}

if (count($err) === 0) {
    // ユーザを登録する処理
    $hasCreated = UserLogic::createUser($_POST);

    if(!$hasCreated) {
        return false;
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザ登録完了画面</title>
</head>
<body>
    <?php if (count($err) > 0) {?>
        <?php foreach($err as $e) { ?>
            <p><?php echo $e; ?></p>
        <?php } ?>
    <?php } else {  ?>
        <h2>ユーザ登録が完了しました</h2>
    <?php } ?>
    <a href="./signup_form.php">戻る</a>
</body>
</html>