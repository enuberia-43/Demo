<?php
include("includes/header.php");
require 'includes/form_handlers/register_handler.php';

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP App</title>
</head>
<body>

    <form action="register.php" method="POST">
        <div>ユーザーネーム</div>
        <input type="text" name="username" value="<?php 
		if(isset($_SESSION['username'])) {
			echo $_SESSION['username'];
		} 
		?>"required>
		<br>
        <div>メールアドレス</div>
        <input type="email" name="reg_email" value="<?php
        if(isset($_SESSION['reg_email'])) {
            echo $_SESSION['reg_email'];
        }
        ?>"required>
        <br>
        <?php if(in_array("すでに使用されているメールアドレスです<br>", $error_array)) echo "すでに使用されているメールアドレスです<br>";
        else if(in_array("無効なメールアドレス形式です<br>", $error_array)) echo "無効なメールアドレス形式です<br>"; ?>
        <div>パスワード</div>
        <input type="password" name="reg_password" required>
        <br>
        <div>パスワードの確認</div>
        <input type="password" name="reg_password2" required>
        <br>
        <?php if(in_array("パスワードが一致しません<br>", $error_array)) echo "パスワードが一致しません<br>";
        else if(in_array("パスワードは半角英数字で入力してください<br>", $error_array)) echo "パスワードは半角英数字で入力してください<br>"; 
        else if(in_array("パスワードは5～30文字で入力してください<br>", $error_array)) echo "パスワードは5～30文字で入力してください<br>"; ?>
        <input type="submit" name="register_button" value="登録する">
        <br>
    </form>
</body>
</html>