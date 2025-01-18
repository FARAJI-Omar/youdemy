<?php
include '../classes/admin.cl.php';

$admin = new admin();
$admin->delete_category($_GET['category_id']);

header('Location: ../admin_dash_categories.php');
?>