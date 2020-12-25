<?php
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP APP</title>
</head>
<body>
    <div class="content">
        <?php
        $userLoggedIn = "";
        $post = new Post($con, $userLoggedIn);
        $post->loadPost();
        ?>
    </div>
</body>
</html>