<?php
function emptyInput($post_arr, $fields)
{
    foreach ($fields as $field) {
        if (empty($post_arr[$field])) {
            return true;
            exit();
        }
    }

    return false;
}

function invalidUsername($username)
{
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        return true;
        exit();
    }
    return false;
}

function invalidEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
        exit();
    }
    return false;
}
function passwordsMatch($password, $repassword)
{
    if ($password !== $repassword) {
        return true;
        exit();
    }
    return false;
}
