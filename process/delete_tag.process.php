<?php
include '../classes/admin.cl.php';
$admin = new admin();
$admin->delete_tag($_GET['tag_id']);
header('Location: ../admin_dash_tags.php');
?>