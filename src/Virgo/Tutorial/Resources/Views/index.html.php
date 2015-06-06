<?php
/**
 * @var $user
 * @var $email
 * @var $loginErrors
 */
?>
<form method="POST">
    <label for="email">E-mail address:</label><br>
    <input id="email" type="text" name="email" value="<?php echo $email; ?>"><br>
    <label for="password">Password:</label><br>
    <input id="password" type="password" name="password"><br>
    <br><input type="submit" name="login" value="Login">
    <a href="/registration"> <input type="button" name="register" value="Registration"></a>
</form>

<?php
echo '<br>';
if (!empty($variables["notices"])) {
    echo 'Notice: <br>';
    foreach ($variables["notices"] as $notice) {
        echo $notice . '<br>';
    }
}
if (!empty($variables['loginErrors'])) {
    echo 'Errors: <br><div style="color:#FF0000;">';
    foreach ($variables["loginErrors"] as $error) {
        echo $error . '<br>';
    }
    echo '</div>';
}
?>
