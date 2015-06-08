<!DOCTYPE html>
<html>
<head>
    <title>
        Registration
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<link rel="stylesheet" type="text/css" href="css/style.css">
<div class="wrapper">
    <h1>Registration</h1>

    <div class="content">
        <form method="POST">
            <label for="name">Name: </label><br>
            <input id="name" type="text" name="name" value="<?php if (isset($session)) {
                echo $session->get('userName');
            } ?>"><br>
            <label for="password">Password:</label><br>
            <input id="password" type="password" name="password"><br>
            <label for="email">E-mail address:</label><br>
            <input id="email" type="text" name="email" value="<?php if (isset($session)) {
                echo $session->get('email');
            } ?>"><br><br>
            <input type="submit" name="registrate" value="Send">
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
