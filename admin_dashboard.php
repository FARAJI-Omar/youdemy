<?php
require_once 'classes/admin.cl.php';
require_once 'classes/user.cl.php';

$admin = new admin();

$total_courses = $admin->get_total_courses();
$courses_distribution = $admin->get_courses_distribution();
$course_with_most_enrollments = $admin->get_course_with_most_enrollments();
$top_teachers = $admin->get_top_teachers();
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
        <?php include 'header.php'; ?>
    </div>

    <div class="admin_body">
        <aside>
            <img src="img/User profile.png" class="admin-profile">
            <a href="admin_dashboard.php" style="text-decoration: none;">
                <h3 class="admin-name"><?php echo $_SESSION['username']; ?></h3>
            </a>
            <a href="admin_manage_users.php">Manage users</a>
            <a href="admin_manage_content.php">Manage content</a>
            <a href="process/logout.php">Logout</a>
        </aside>

        <div class="main-container">
            <div class="content-section" id="welcome">
                <h1>Welcome to the admin dashboard: <?php echo $_SESSION['username']; ?></h1>
            </div>

            <div class="statistics_section">
                <div class="stat-box">
                    <h2>Total Courses: </h2>
                    <h3><?php echo $total_courses; ?></h3>
                </div>
                <div class="stat-box">
                <h2>Top 3 Teachers:</h2>
                <ul>
                    <?php foreach ($top_teachers as $teacher): ?>
                        <li><?php echo htmlspecialchars($teacher['username']) . ": " . $teacher['total_enrollments'] . " enrollments"; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="stat-box">
                <h2>Course with Most Enrolled Students:</h2>
                <?php if ($course_with_most_enrollments): ?>
                    <p><?php echo "<strong>" . htmlspecialchars($course_with_most_enrollments['title'])."</strong>" . " with: " . "<br>" . "<strong>" . $course_with_most_enrollments['total_enrollments'] . " enrollments.</strong>"; ?></p>
                <?php else: ?>
                    <p>No enrollments found.</p>
                <?php endif; ?>

                </div>
                <div class="stat-box">
                    <h2>Course Distribution by Category:</h2>
                    <ul>
                        <?php foreach ($courses_distribution as $category): ?>
                            <li><strong><?php echo htmlspecialchars($category['category_name']) . ":</strong>  " . $category['total_courses']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
               
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>