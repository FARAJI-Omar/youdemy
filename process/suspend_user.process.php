<?php 
require_once '../classes/db.php';
require_once '../classes/admin.cl.php';

$admin = new admin();
$admin->suspend_user($_GET['user_id']);
if($admin->suspend_user($_GET['user_id'])){
    header('Location: ../admin_dashboard.php');
}else{
    header('Location: ../admin_dashboard.php?error');
}

?>