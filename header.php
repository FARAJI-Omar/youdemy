<header class="header">
    <a href="index.php" class="logo">
        <div class="logo-icon"></div>
        <span class="logo-text">YOUDEMY</span>
    </a>

    <nav class="nav-menu">
        <a href="index.php" class="nav-link">Home</a>
        <a href="all_courses.php" class="nav-link">All Courses</a>
        <a href="about.php" class="nav-link">About</a>
        <a href="#" class="nav-link" onclick="scrollToBottom()">Contact</a>
        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="login.php" class="start-learning-btn">Start now</a>
        <?php else:
            if ($_SESSION['user_role'] === 'admin') {
                $dashboardLink = 'admin_dashboard.php';
                $roleDisplay = 'Admin';
            } elseif ($_SESSION['user_role'] === 'teacher') {
                $dashboardLink = 'teacher_dashboard.php';
                $roleDisplay = 'Teacher';
            } else {
                $dashboardLink = 'student_dashboard.php';
                $roleDisplay = 'Student';
            }
        ?>
            <a href="<?php echo $dashboardLink; ?>" class="start-learning-btn">Dashboard</a>
        <?php endif; ?>
    </nav>
</header>

<script>
    function scrollToBottom() {
        window.scrollTo({
            top: document.documentElement.scrollHeight,
            behavior: 'smooth'
        });
    }
</script>