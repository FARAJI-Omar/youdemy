<?php
require_once 'classes/login.cl.php';
require_once 'classes/teacher.cl.php';
require_once 'classes/user.cl.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Manage Courses</title>
</head>

<body>
    <div class="admin-header">
        <?php include 'header.php'; ?>
    </div>

    <div class="admin_body">
        <aside>
            <img src="img/User profile.png" class="admin-profile">
            <a href="teacher_dashboard.php" style="text-decoration: none;">
                <h3 class="admin-name"><?php echo $_SESSION['username']; ?></h3>
            </a>
            <a href="teacher_add_course.php">Add new course</a>
            <a href="teacher_manage_courses.php">Manage courses</a>
            <a href="teacher_statistics.php">Statistics</a>
            <a href="process/logout.php">Logout</a>
        </aside>

        <div class="main_cont">
            <div class="content_sec">
                <h1>Manage Courses</h1>

                <div class="courses-table">
                    <?php 
                    $teacher = new teacher();
                    $teacher->get_courses(); 
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>