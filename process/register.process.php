<?php
require_once 'classes.php/db.php';
require_once 'classes.php/register.cl.php';

$register = new register();

if (isset($_POST['register'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $role = htmlspecialchars(trim($_POST['role']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirmPassword = htmlspecialchars(trim($_POST['confirmPassword']));

    if ($register->registerUser($username, $email, $password, $confirmPassword, $role)) {
        header('Location: login.php');
        exit();
    } else {
        $msg_error = $register->register_error;
    }
}
