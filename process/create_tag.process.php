<?php
include '../classes/admin.cl.php';

$admin = new admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch the JSON data from the input field
    $tagsData = $_POST['tag_name'];

    // Decode the JSON string into an array
    $tags = json_decode($tagsData, true);

    $tagsArray = explode(',', $tagsData);

    // Insert each tag into the database
    foreach ($tags as $tag) {
        if (!empty($tag['value'])) {
            $admin->create_tag($tag['value']);
        }
    }
}

header('Location: ../admin_dash_tags.php');
?>