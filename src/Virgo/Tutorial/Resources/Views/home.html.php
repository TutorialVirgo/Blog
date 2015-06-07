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
    <?php if (!isset($session) || $session->get('email') === null) : ?>
        <h1> Error 403 - Unauthorized</h1>
        <div class="errors"> You have to log in to view this content!
            <?php header("HTTP/1.1 403 Unauthorized"); ?>
            <br><br>
            <a href="/"> <input type="button" name="login" value="Log in"></a>
        </div>
        <?php exit;
    endif; ?>

    <h1>Home</h1>

    <div class="content">
        <?php echo '<br>Hello ', $session->get('userName'), '!<br><br>'; ?>
        <a href="/logout"> <input type="button" name="logout" value="Log out"></a>
    </div>
</div>
</body>
</html>
