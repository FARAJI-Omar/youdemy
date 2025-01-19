<?php
require_once 'classes/admin.cl.php';
require_once 'classes/login.cl.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Admin Dashboard</title>
</head>

<body>
    <div class="admin-header">
        <?php include 'header.php';?>
        
    </div>

    <div class="admin_body">
        <aside>
            <img src="img/User profile.png" class="admin-profile">
            <a href="admin_dashboard.php" style="text-decoration: none;"><h3 class="admin-name"><?php echo $_SESSION['username'];?></h3></a>
            <a href="admin_manage_users.php">Manage users</a>
            <a href="admin_manage_content.php">Manage content</a>
            <a href="admin_statistics.php">Statistics</a>
            <a href="process/logout.php">Logout</a>
        </aside>

        <div class="main-container">
            <div class="content-section" id="welcome">
                <h1>Welcome to the admin dashboard: <?php echo $_SESSION['username'];?></h1>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>