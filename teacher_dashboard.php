<?php
require_once 'classes/user.cl.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Teacher Dashboard</title>
</head>

<body>
    <div class="admin-header">
        <?php include 'header.php';?>
    </div>

    <div class="admin_body">
        <aside>
            <img src="img/User profile.png" class="admin-profile">
            <a href="teacher_dashboard.php" style="text-decoration: none;"><h3 class="admin-name"><?php echo $_SESSION['username'];?></h3></a>
            <a href="teacher_add_course.php">Add new course</a>
            <a href="teacher_manage_courses.php">Manage courses</a>
            <a href="teacher_statistics.php">Statistics</a>
            <a href="process/logout.php">Logout</a>
        </aside>

        <div class="main-container">
            <div class="content-section" id="welcome">
                <h1>Welcome to the teacher dashboard: <?php echo $_SESSION['username'];?></h1>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>