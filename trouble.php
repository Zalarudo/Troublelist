<?php

require_once 'funcs.php';

$errors = "";
if(!isLoggedin()){
    $_SESSION['msg'] = "You must log in first";
    header('location:login.php');
}
$db = mysqli_connect('host', 'login', 'pass', 'bdname');
$user_name = $_SESSION['user']['username'];
$user_id = $_SESSION['user']['id'];


if(isset($_POST['submit'])){
    $task = $_POST['task'];

    if(empty($task)){
        $errors = "У тебя не может быть все хорошо, не лги хотя бы себе!";
    }else{

        mysqli_query($db, "INSERT INTO tasks (user_id, task) VALUES ('$user_id', '$task')");
        header('location: trouble.php');

    }
}

if(isset($_GET['del_task'])){

    $id = $_GET['del_task'];
    mysqli_query($db, "DELETE FROM tasks WHERE id= '$id'");
    header('location: trouble.php');
}

$tasks =  mysqli_query($db, "SELECT * FROM tasks WHERE user_id = '$user_id'");


//important trouble

    if(isset($_GET['imp_task'])){

        $id = $_GET['imp_task'];
        mysqli_query($db, "UPDATE tasks SET important = '&#9733;' WHERE id = '$id'");
        header('location: trouble.php');

    }



?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>My troubles</title>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>

</head>
<body>


<div class="heading">
    <h2> My name is <?php echo $user_name ?> and i have troubles </h2>
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
        <th>Важное</th>
        <th>Решено</th>
        <!-- <th>Начать</th> -->
    </tr>
    </thead>
    <tbody>

    <?php

    $i = 1;
    while ($row = mysqli_fetch_array($tasks)){ ?>
        <tr>
            <td class = "numb"><?php echo $i;?></td>
            <td class = "task"><?php echo $row['task'];?></td>
            <td class = "inproccess"><a href="trouble.php?imp_task=<?php echo $row['id']; ?>"><?php echo $row['important']; ?></a></td>
            <td class = "delete">
                <a href="trouble.php?del_task=<?php echo $row['id'];?>">&#9745;</a>
            </td>
            <!-- <td class = "timer"><span id="timer_count"></span></td> -->

        </tr>

        <?php  $i++; } ?>
    </tbody>

</table>
<button class="add_btn logout_btn"><a href="trouble.php?logout='1'">Выйти</a></button>




</body>
</html>


