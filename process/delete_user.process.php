<?php 
require_once '../classes/db.php';
require_once '../classes/admin.cl.php';

$admin = new admin();

$admin->delete_user($_GET['user_id']);
$message = "User deleted successfully"; 

header("Location: ../admin_manage_users.php?message=$message");
exit();
?>