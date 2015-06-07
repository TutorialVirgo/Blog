<?php
/**
 * @var $user
 * @var $email
 * @var $loginErrors
 */
?>
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

<?php
if (isset($session)) {
    echo '<br>';
    if (!empty($session->get("notices"))) {
        echo 'Notice: <br>';
        foreach ($session->get("notices") as $notice) {
            echo $notice . '<br>';
        }
    }
    if (!empty($session->get("loginErrors"))) {
        echo 'Errors: <br><div style="color:#FF0000;">';
        foreach ($session->get("loginErrors") as $error) {
            echo $error . '<br>';
        }
        echo '</div>';
    }
}
?>
