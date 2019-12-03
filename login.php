<?php require_once 'funcs.php'?>
<!DOCTYPE html>
<html>
<head>
    <title>Login trouble list</title>
    <link rel="stylesheet" type="text/css" href="regstyle.css">
</head>
<body>
<div class="heading">
    <h2> Авторизация </h2>
</div>
<form method="post" action="login.php">

    <?php echo display_error(); ?>

    <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" >
    </div>
    <div class="input-group">
        <label>Password</label>
        <input type="password" name="password">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="login_btn">Login</button>
    </div>
    <p>
        У вас нет аккаунта? <a href="index.php">Sign in</a>
    </p>
</form>
</body>
</html>