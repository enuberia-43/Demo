<?php
//require 'config/config.php';
include("includes/header.php");
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';


?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP App</title>
</head>
<body>
    
    <form action="login.php" method="POST">
        <div>メールアドレス</div>
        <input type="email" name="log_email" value="<?php
        if(isset($_SESSION['log_email'])) {
            echo $_SESSION['log_email'];
        }
        ?>"required>
        <br>
        <div>パスワード</div>
        <input type="password" name="log_password">
        <br>
        <input type="submit" name="login_button" value="ログイン">
        <br>

        <?php if(in_array("Eメールまたはパスワードが違います<br>", $error_array)) echo "Eメールまたはパスワードが違います<br>";  ?>

    </form>
</body>
</html>