<?php
require_once 'classes/student.cl.php';

if ($_SESSION['user_role'] !== 'student') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>
<div class="admin-header">
    <?php include 'header.php'; ?>
</div>
<div class="admin_body">
        <aside>
            <img src="img/User profile.png" class="admin-profile">
            <a href="student_dashboard.php" style="text-decoration: none;"><h3 class="admin-name"><?php echo $_SESSION['username'];?></h3></a>
            <a href="all_courses.php">View courses</a>
            <a href="my_courses.php">My courses</a>
            <a href="process/logout.php">Logout</a>
        </aside>

        <div class="main-container">
            <div class="content-section" id="welcome">
                <h1>Glad to see you again <?php echo $_SESSION['username'];?></h1>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>
    

</body>
</html>