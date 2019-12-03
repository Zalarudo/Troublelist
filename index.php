<?php require_once 'funcs.php';?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="regstyle.css">
    <title>Your troubles</title>
</head>
<body>
    <div class="heading">
        <h2>
            Manage your problems </h2>
    </div>


    <div class="header">
        <h2>Регистрация</h2>
    </div>
    <form method="post" action="index.php">

        <?php echo display_error(); ?>

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password_1">
        </div>
        <div class="input-group">
            <label>Confirm password</label>
            <input type="password" name="password_2">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="register_btn">Зарегистрироваться</button>
        </div>
        <p>
            Есть аккаунт? <a href="login.php">Войти</a>
        </p>
    </form>
</body>
</html>