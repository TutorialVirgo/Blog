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
    <input id="name" type="text" name="name" value="<?php echo $userName; ?>"><br>
    <label for="password">Password:</label><br>
    <input id="password" type="password" name="password"><br>
    <label for="email">E-mail address:</label><br>
    <input id="email" type="text" name="email" value="<?php echo $email; ?>"><br>
    <input type="submit" name="registrate" value="Send">
</form>
<?php

echo '<br>';
if (!empty($variables["errors"])) {
    echo 'Errors: <br><div style="color:#FF0000;">';
    foreach ($variables["errors"] as $error) {
        echo $error . '<br>';
    }
    echo '</div>';
}
?>

</body>
</html>
