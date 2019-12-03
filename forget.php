<?php require_once 'funcs.php'; ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Воостановление пароля</title>
    <link rel="stylesheet" type="text/css" href="css/regstyle.css">
</head>
<body>

<div class="header">
    <h2>Замена пароля</h2>
</div>
<form method="post" action="forget.php">

    <?php echo display_error(); ?>

    <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" value="<?php echo $username; ?>">
    </div>
    <div class="input-group">
        <label>New Password</label>
        <input type="password" name="password_1">
    </div>
    <div class="input-group">
        <label>Confirm new password</label>
        <input type="password" name="password_2">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="change_btn">Сменить пароль</button>
    </div>
    <p>
        Вспомнили? <a href="login.php">Войти</a>
    </p>
</form>

</body>
</html>
