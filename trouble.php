<?php

require_once 'funcs.php';

$errors = "";
if(!isLoggedin()){
    $_SESSION['msg'] = "You must log in first";
    header('location:login.php');
}
$db = mysqli_connect('141.8.192.153', 'a0334946_todotask', '123789', 'a0334946_todotask');
$users_task = $_SESSION['user']['username'];

if(isset($_POST['submit'])){
    $task = $_POST['task'];

    if(empty($task)){
        $errors = "У тебя не может быть все хорошо, не лги хотя бы себе!";
    }else{
        mysqli_query($db, "INSERT INTO $users_task (task) VALUES ('$task') ");
        header('location: trouble.php');
    }
}

if(isset($_GET['del_task'])){

    $id = $_GET['del_task'];
    mysqli_query($db, "DELETE FROM $users_task WHERE id=$id");
    header('location: trouble.php');
}

$tasks =  mysqli_query($db, "SELECT * FROM $users_task");


?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>My troubles</title>
</head>
<body>


<div class="heading">
    <h2> My name is <?php echo $users_task ?> and i have troubles </h2>
</div>
<form method="POST" action="trouble.php">

    <?php if(isset($errors)){?>

        <p><?php echo $errors;

        ?></p>

    <?php }?>
    <input type="text" name="task" class = "task_input">
    <button type="submit" class = "add_btn" name = "submit"> Добавить проблему</button>
</form>

<table>
    <thead>
    <tr>
        <th>№</th>
        <th>Проблема</th>
        <th>Удалить</th>
    </tr>
    </thead>
    <tbody>

    <?php

    $i = 1;
    while ($row = mysqli_fetch_array($tasks)){ ?>
        <tr>
            <td class = "numb"><?php echo $i;?></td>
            <td class = "task"><?php echo $row['task'];?></td>
            <td class="delete">
                <a href="trouble.php?del_task=<?php echo $row['id'];?>">x</a>
            </td>
        </tr>

        <?php  $i++; } ?>

    </tbody>

</table>

<button class="add_btn logout_btn"><a href="trouble.php?logout='1'">Выйти</a></button>
</body>
</html>