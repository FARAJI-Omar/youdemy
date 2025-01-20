<?php
require_once 'classes/db.php';
require_once 'classes/user.cl.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $role = $_POST['role'];

    $register = new user();
    $register->registerUser ($username, $email, $password, $confirmPassword, $role);
    header('Location: login.php?success=registered');
    exit();
}
