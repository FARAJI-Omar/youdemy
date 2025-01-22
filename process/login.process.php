<?php
require_once 'classes/db.php';
require_once 'classes/user.cl.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $user = new user();
    $user->login($email, $password);
}
