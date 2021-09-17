<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {

    require_once "../model/user.php";
    require_once "functions.php";


    $fields = array('username', 'password');

    if (emptyInput($_POST, $fields) !== false) {
        header('Location: ../login.php?error=emptyinput');
        exit();
    }


    $username =  $_POST['username'];
    $password =  $_POST['password'];

    $user = new User();
    $user->username =  $username;
    $user->email =  $username;
    // $user->passwd = password_hash($password, PASSWORD_DEFAULT);


    //check if username valid
    if ($user->userExists() !== true) {
        header('Location: ../login.php?error=invalidusername');
        exit();
    }

    if (password_verify($password, $user->passwd) === false) {
        header('Location: ../login.php?error=invalidlogin');
        exit();
    } else {
        session_start();
        $_SESSION["userid"] = $user->userId;
        $_SESSION["username"] = $user->username;
        header('Location: ../index.php');
        exit();
    }
} else {
    header('Location: ../login.php');
    exit();
}
