<!DOCTYPE html>
<html>
<head>
    <title>
        Registration
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>

Registration<br><br>

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
    } ?>"><br>
    <input type="submit" name="registrate" value="Send">
</form>
<?php
if (isset($session)) {
    echo '<br>';
    if (!empty($session->get("errors"))) {
        echo 'Errors: <br><div style="color:#FF0000;">';
        foreach ($session->get("errors") as $error) {
            echo $error . '<br>';
        }
        echo '</div>';
    }
}
?>

</body>
</html>
