<?php
require_once 'classes.php/db.php';
require_once 'classes.php/login.cl.php';

$login = new login();

if (isset($_POST['login'])) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));


    if ($login->login($email, $password)) {
        header('Location: login.php');
        exit();
    } else {
        $msg_error = $login->login_error;
    }
}
