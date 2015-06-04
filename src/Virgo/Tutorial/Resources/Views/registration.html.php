<!DOCTYPE html>
<html>
<head>
    <title>
        Registration
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<?php

echo "Errors: <br>";
foreach ($variables as $error) {
    echo $error . '<br>';
}
echo "<br>";
?>
Registration<br><br>
<form method="POST">
    <label for="name">Name: </label><br>
    <input id="name" type="text" name="name"><br>
    <label for="password">Password:</label><br>
    <input id="password" type="password" name="password"><br>
    <label for="email">E-mail address:</label><br>
    <input id="email" type="text" name="email"><br>
    <input type="submit" name="registrate" value="Send">
</form>
</body>
</html>
