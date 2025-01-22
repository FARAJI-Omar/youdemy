<?php
require_once 'classes/db.php';
require_once 'classes/user.cl.php';

$register = new user();
$msg_r = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirmPassword = htmlspecialchars($_POST['confirmPassword']);
    $role = htmlspecialchars($_POST['role']);

    if ($register->registerUser($username, $email, $password, $confirmPassword, $role)) {
        header('Location: login.php?success=registered');
        exit();
    } else {
        $msg_error = $register->register_error;
    }
}
