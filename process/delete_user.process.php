<?php 
require_once '../classes/db.php';
require_once '../classes/admin.cl.php';

$admin = new admin();
$admin->delete_user($_GET['user_id']);
if($admin->delete_user($_GET['user_id'])){
    header('Location: ../admin_manage_users.php');
}else{
    header('Location: ../admin_manage_users.php');
}
?>