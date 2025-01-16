<?php
require_once 'classes/db.php';
require_once 'classes/login.cl.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login = new login();
    $login->login($email, $password);
}
?>
