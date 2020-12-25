<?php
require 'config/config.php';

if(isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP App</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div id="container">
        <div class="header">
            <div class="logo">
                <a href="index.php">PHP App</a>
            </div>
            <nav>
                <ul>
                    <?php if(isset($_SESSION['login'])) {
                        $link_post = "post.php";
                        $link_logout = "includes/handlers/logout.php";
                        echo "<li><a href=". $link_post .">投稿する</a></li>";
                        echo "<li><a href=". $link_logout .">ログアウト</a></li>";
                    }
                    else{
                        $link_register = "register.php";
                        $link_login = "login.php";
                        echo "<li><a href=". $link_register .">新規登録</a></li>";
                        echo "<li><a href=". $link_login .">ログイン</a></li>";

                    }?>
                </ul>
            </nav>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.js"></script>
</body>
</html>