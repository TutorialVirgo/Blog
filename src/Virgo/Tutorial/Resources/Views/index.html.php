<?php echo '<br>Hello ', $user;
echo '<br><br>' ?>
<form method="POST">
    <label for="email">E-mail address:</label><br>
    <input id="email" type="text" name="email"><br>
    <label for="password">Password:</label><br>
    <input id="password" type="password" name="password"><br>
    <br><input type="submit" name="login" value="Login">
    <a href="/registration"> <input type="button" name="register" value="Registration"></a>
</form>
