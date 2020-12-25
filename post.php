<?php
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");

if(isset($_POST['post'])) {
    $post = new Post($con, $userLoggedIn);
    $post->submitPost($_POST['post_text']);
    header("Location: index.php");

}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP App</title>
</head>
<body>
    <div class="main_colum colum">
        <form class="post_form" action="post.php" method="POST">
            <textarea name="post_text" id="post_text"></textarea>
            <input type="submit" name="post" id="post_button" value="投稿">
            <hr>
    </div>
</body>
</html>