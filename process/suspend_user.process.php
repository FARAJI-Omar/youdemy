<?php 
require_once '../classes/db.php';
require_once '../classes/admin.cl.php';

$admin = new admin();
$admin->suspend_user($_GET['user_id']);

if($_GET['status'] === 'suspended'){

    if($admin->activate_user($_GET['user_id'])){
        header('Location: ../admin_manage_users.php');

    }else{
        header('Location: ../admin_manage_users.php');
    }

}elseif($_GET['status'] === 'active'){
    
    if($admin->suspend_user($_GET['user_id'])){
        header('Location: ../admin_manage_users.php');
    }else{
        header('Location: ../admin_manage_users.php');
    }
}


?>