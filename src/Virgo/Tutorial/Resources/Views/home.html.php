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

            <p class="postAuthor">Posted by:  <?php echo $post->getEmail();?>
                <br> Last Modified on <?php echo $post->getModifiedDate()->format('Y-m-d \a\t H:i:s');?></p>

            <?php if ($session->get('email') === $post->getEmail()) : ?>
                <form class="postActions" method="POST" action="/edit/<?php echo $post->getId(); ?>">
                    <input class="postActions" type="submit" name="edit" value="Edit">
                    <input  name="postAuthor" type="hidden" value="<?php echo $post->getEmail(); ?>">
                </form>
                <form class="postActions" method="POST" action="/delete/<?php echo $post->getId(); ?>">
                    <input class="postActions" type="submit" name="delete" value="Delete">
                    <input name="postAuthor" type="hidden"  value="<?php echo $post->getEmail(); ?>">
                </form>
            <?php endif; ?>

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
