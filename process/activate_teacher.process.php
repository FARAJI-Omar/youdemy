<?php
require_once '../classes/db.php';
require_once '../classes/admin.cl.php'; 

$admin = new admin();
if (isset($_GET['user_id']) && isset($_GET['status'])) {
    if ($_GET['status'] === 'pending') {
        $admin->activate_teacher($_GET['user_id']);
    } elseif ($_GET['status'] === 'active') {
        $admin->deactivate_teacher($_GET['user_id']);
    }
    header('Location: ../admin_dashboard.php');
    exit();
} else {
    header('Location: admin_dashboard.php?error');
    exit();
}
