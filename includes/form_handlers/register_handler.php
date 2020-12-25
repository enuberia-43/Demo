<?php

$username =""; //ユーザーネーム
$em = ""; //メールアドレス
$password = ""; //パスワード
$password2 = ""; //パスワード2
$date = ""; //登録日
$error_array = array(); //エラーメッセージ格納

if(isset($_POST['register_button'])) {
    $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
    $username = strip_tags($_POST['username']); //HTMLタグ削除
    $username = str_replace(array(' ', '　'), '', $username); //スペース削除
    $username = strtolower($username);
    $_SESSION['username'] = $username;

    $em = htmlspecialchars($em, ENT_QUOTES, 'UTF-8');
    $em = strip_tags($_POST['reg_email']); //HTMLタグ削除
    $em = str_replace(array(' ', '　'), '', $em); //スペース削除
    $em = strtolower($em);
    $_SESSION['reg_email'] = $em;
    
    $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');
    $password = strip_tags($_POST['reg_password']); //HTMLタグ削除
    $password2 = htmlspecialchars($password2, ENT_QUOTES, 'UTF-8');
    $password2 = strip_tags($_POST['reg_password2']); //スペース削除

    $date = date("Y-m-d"); //日付

    //メールアドレスのフォーマットチェック
    if(filter_var($em, FILTER_VALIDATE_EMAIL)) {
        $em = filter_var($em, FILTER_VALIDATE_EMAIL);

        //メールアドレスが既に存在しているかチェック
        $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

        $num_rows = mysqli_num_rows($e_check);

        if($num_rows > 0) {
            array_push($error_array, "すでに使用されているメールアドレスです<br>");
        }
    }
    else {
        array_push($error_array, "無効なメールアドレス形式です<br>");
    }

    if($password != $password2) {
        array_push($error_array, "パスワードが一致しません<br>");
    }
    else {
        if(preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($error_array, "パスワードは半角英数字で入力してください<br>");
        }
    }

    if(strlen($password) > 30 || strlen($password) < 5) {
        array_push($error_array, "パスワードは5～30文字で入力してください<br>");
    }

    if(empty($error_array)) {
        $password = md5($password); //暗号化

        //$username = strtolower($name);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");


		$i = 0; 
		while(mysqli_num_rows($check_username_query) != 0) {
			$i++;
			$username = $username . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
		}

        $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$username', '$em', '$password', '$date')");

        $_SESSION['login'] = 1;
        
        header("Location: index.php");
        //セッション変数削除
        //$_SESSION['username'] = "";
        //$_SESSION['reg_email'] = "";
    }
}

?>