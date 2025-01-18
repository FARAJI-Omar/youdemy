<?php 
require_once '../classes/db.php';
require_once '../classes/admin.cl.php';

$admin = new admin();

if (isset($_GET['user_id']) && isset($_GET['status'])) {
    $user_id = htmlspecialchars($_GET['user_id']);
    $status = htmlspecialchars($_GET['status']);

    if ($status === 'suspended') {
        $admin->activate_user($user_id);
        $message = "User activated successfully";
    } elseif ($status === 'active') {
        $admin->suspend_user($user_id);
        $message = "User suspended successfully";
    } else {
        $message = "Invalid action";
    }

    header("Location: ../admin_manage_users.php?message=$message");
    exit();
} else {
    // Redirect back with an error message if parameters are missing
    header("Location: ../admin_manage_users.php?message=Invalid request");
    exit();
}
?>
