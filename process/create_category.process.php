<?php
session_start();
require_once '../classes/admin.cl.php';

if (isset($_POST['category_name']) && !empty($_POST['category_name'])) {
    $admin = new admin();
    $admin->create_category($_POST['category_name']);
    $message = "Category created successfully";
} else {
    $message = "Category creation failed";
}
header("Location: ../admin_dash_categories.php?message=$message");
exit();
