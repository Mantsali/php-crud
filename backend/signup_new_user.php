<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {


    require_once "../model/user.php";
    require_once "functions.php";

    $fields = array('name', 'username', 'email', 'password', 'rpassword');

    if (emptyInput($_POST, $fields) !== false) {
        header('Location: ../signup.php?error=emptyinput');
        exit();
    }

    $fullname =  $_POST['name'];
    $username =  $_POST['username'];
    $email =  $_POST['email'];
    $password =  $_POST['password'];
    $repassword =  $_POST['rpassword'];

    //check if username valid
    if (invalidUsername($username) !== false) {
        header('Location: ../signup.php?error=invalidusername');
        exit();
    }
    //check if email valid
    if (invalidEmail($email) !== false) {
        header('Location: ../signup.php?error=invalidemail');
        exit();
    }
    //check if passwords match
    if (passwordsMatch($password, $repassword) !== false) {
        header('Location: ../signup.php?error=passwordsdontmatch');
        exit();
    }
    //check if userid and email exists
    $user = new User();
    $user->fullname = $fullname;
    $user->username =  $username;
    $user->email =  $email;
    $user->passwd = password_hash($password, PASSWORD_DEFAULT);

    /*
    if ($user->userExists() !== false) {
        header('Location: ../signup.php?error=userexists');
        exit();
    }

*/
    //create user
    header('Location: ../signup.php?error=' . $user->createUser());


    exit();
} else {
    header('Location: ../signup.php');
    exit();
}
