<?php if (!isset($session) || $session->get('email') === null) {
    header("HTTP/1.1 403 Unauthorized");
    echo "You are not authorized to view this content!";
    echo '<br><br><a href="/"> <input type="button" name="login" value="Log in"></a>';
    exit;
}
?>

<h1>Home</h1>

<?php echo '<br>Hello ', $session->get('userName'), '!<br><br>'; ?>
<a href="/logout"> <input type="button" name="logout" value="Log out"></a>
