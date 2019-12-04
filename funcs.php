<?php
session_start();

$db = mysqli_connect('host', 'login', 'pass', 'basename');

$username = "";
$errors = array();

if(isset($_POST['register_btn'])){
    register();
}

function register(){
    global $db, $errors, $username;

    $username= e($_POST['username']);
    $password_1 = e($_POST['password_1']);
    $password_2 = e($_POST['password_2']);

    $zap = "SELECT * FROM users WHERE username = '$username' LIMIT 1" ;
    $checklog = mysqli_query($db, $zap);



    // проверяем на ошибки заполнения
    if(empty($username)){
        array_push($errors, "Username is required");
    }
    if(mysqli_num_rows($checklog) == 1){
        array_push($errors, "This login is already taken");
    }
    if(empty($password_1)){
        array_push($errors, "Password is required");
    }
    if(empty($password_2)){
        array_push($errors, "The two passwords do not match");
    }

    if(count($errors) == 0){
        $password = md5($password_1); //шифруем пароль

            $query = "INSERT INTO users (username, user_type, password) VALUES ('$username', 'user', '$password')";
            mysqli_query($db, $query);
            $logged_in_user_id = mysqli_insert_id($db);
            $_SESSION['user'] = getUserById($logged_in_user_id);
            $_SESSION['success'] = "You are now logged in";

        header('location: trouble.php');
    }


}

// получаем массив с пользователями

function getUserById($id){

    global $db;
    $query = "SELECT * FROM users WHERE id=" . $id;
    $result = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($result);
    return $user;
}

function e($val)
{
    global $db;
    return mysqli_real_escape_string($db, trim($val));
}

function display_error(){
    global $errors;
    if(count($errors)>0){
        echo '<div class="error">';
        foreach($errors as $error){
            echo $error . '<br>';
        }echo '</div>';
    }

}

// проверка авторизован ли пользователь
function isLoggedIn() {
    if(isset($_SESSION['user'])){
        return true;
    }else {
        return false;
    }
}


//вход в систему


if(isset($_POST['login_btn'])){
    login();

}

function login(){

    global $db, $username, $errors;

    $username = e($_POST['username']);
    $password = e($_POST['password']);

    if(empty($username)){

        array_push($errors, "Username is required");
    }
    if(empty($password)){
        array_push($errors, "Password is required");
    }

    if(count($errors) == 0){
        $password = md5($password);

        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' LIMIT 1";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) == 1){
            $logged_in_user = mysqli_fetch_assoc($result);
            $_SESSION['user'] = $logged_in_user;
            $_SESSION['success'] = "You are now logged in";
            header('location: trouble.php');
        } else{
            array_push($errors, "Wrong username/password combination");
        }
    }







}

//logout function

if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['user']);
    header('location: login.php');
}





//смена пароля
if(isset($_POST['change_btn'])){
    change();

}

function change()
{

    global $db, $username, $errors;

    $username = e($_POST['username']);
    $password_1 = e($_POST['password_1']);
    $password_2 = e($_POST['password_2']);

    if (empty($username)) {

        array_push($errors, "Username is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if (empty($password_2)) {
        array_push($errors, "The two passwords do not match");
    }

    if (count($errors) == 0) {
        $password = md5($password_1); //шифрование пароля

        $query = "UPDATE users SET password = '$password' WHERE username='$username'";
        $result = mysqli_query($db, $query);
        $query2 = "SELECT * FROM users WHERE username = '$username' AND password = '$password' LIMIT 1";
        $result2 = mysqli_query($db, $query2);
        if (mysqli_num_rows($result2) == 1) {
            $_SESSION['success'] = "Your password change success";
            header('location: login.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}

?>
