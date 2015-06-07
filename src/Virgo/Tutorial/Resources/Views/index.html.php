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
<?php
/**
 * @var $user
 * @var $email
 * @var $loginErrors
 */
?>
<div class="wrapper">
    <h1>Login</h1>

    <div class="content">
        <form method="POST">
            <label for="email">E-mail address:</label><br>
            <input id="email" type="text" name="email" value="<?php if (isset($session)) {
                echo $session->get("email");
            } ?>"><br>
            <label for="password">Password:</label><br>
            <input id="password" type="password" name="password"><br>
            <br><input type="submit" name="login" value="Login">
            <a href="/registration"> <input type="button" name="register" value="Registration"></a>
        </form>
    </div>
    <?php
    if (isset($session)) {
        if (!empty($session->get("loginErrors"))) {
            echo '<br><div class="errors">';
            foreach ($session->get("loginErrors") as $error) {
                echo $error . '<br>';
            }
            echo '</div>';
        }
    }
    ?>
</div>
</body>
</html>
