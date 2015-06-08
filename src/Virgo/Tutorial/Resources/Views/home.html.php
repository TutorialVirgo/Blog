<!DOCTYPE html>
<html>
<head>
    <title>
        Home
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<link rel="stylesheet" type="text/css" href="css/style.css">
<div class="wrapper">
    <h1>Home</h1>

    <div class="content">
        <?php use Virgo\Tutorial\Entity\Post;

        echo '<br>Hello ', $session->get('userName'), '!<br><br>'; ?>
        <a href="/logout"> <input type="button" name="logout" value="Log out"></a>
    </div>

    <?php
    /** @var Post[] $posts */
    foreach ($posts as $post) :?>
        <div class="post">
            <p class="postTitle"><?php echo $post->getTitle();?></p>

            <p class="postContent"><?php echo $post->getContent();?></p>

            <p class="postAuthor">
                <a class="postActions" href="/edit/<?php echo $post->getId();?>">Edit</a>
                <a class="postActions" href="/delete/<?php echo $post->getId();?>">Delete</a>
                <?php echo $post->getEmail();?>
            </p>
        </div>
    <?php endforeach ?>

    <div class="post">
        <p class="postTitle">Post something!</p>

        <form method="POST" action="/post">
            <label for="postTitle">Title: </label><br>
            <input id="postTitle" type="text" name="postTitle" value="<?php if (isset($session)) {
                echo $session->get('postTitle');
            } ?>"><br><br>
            <label for="postContent">Content:</label><br>
            <textarea id="postContent" class="text" cols="60" rows="10" name="postContent"><?php if (isset($session)) {
                    echo $session->get('postContent');
                } ?></textarea>
            <br><br>
            <input type="submit" name="post" value="Publish">
        </form>
    </div>
    <?php
    if (isset($session)) {
        if (!empty($session->get("errors"))) {
            echo '<div class="errors">';
            foreach ($session->get("errors") as $error) {
                echo $error . '<br>';
            }
            echo '</div>';
        }
    }
    ?>
</div>
</body>
</html>
