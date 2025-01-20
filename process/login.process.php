<?php
require_once 'classes/db.php';
require_once 'classes/user.cl.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = new user();
    $user->login($email, $password);
}
?>
