<?php

if(isset($_POST['login_button'])) {
    $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);

    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

    $_SESSION['log_email'] = $email;
    $password = md5($_POST['log_password']); 

    $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    $check_login_query = mysqli_num_rows($check_database_query);

    if($check_login_query == 1) {
        $row = mysqli_fetch_array($check_database_query);
        $username = $row['username'];
        $_SESSION['login'] = 1;
        $_SESSION['username'] = $username;
        $_SESSION['log_email'] = $log_email;

        header("Location: index.php");
        exit();
    }
    else {
        array_push($error_array, "Eメールまたはパスワードが違います<br>");
    }
}
?>