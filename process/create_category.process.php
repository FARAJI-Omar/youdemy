<?php
session_start();
require_once '../classes/admin.cl.php';

if (isset($_POST['category_name']) && !empty($_POST['category_name'])) {
    $admin = new admin();
    $admin->create_category($_POST['category_name']);
    header('Location: ../admin_dash_categories.php');
} else {
    header('Location: ../admin_dash_categories.php');
}
exit();
