<header class="header">
    <a href="/" class="logo">
        <div class="logo-icon"></div>
        <span class="logo-text">YOUDEMY</span>
    </a>

    <nav class="nav-menu">
        <a href="index.php" class="nav-link">Home</a>
        <a href="all_courses.php" class="nav-link">All Courses</a>
        <a href="about.php" class="nav-link">About</a>
        <a href="#" class="nav-link" onclick="scrollToBottom()">Contact</a>
        <a href="register.php" class="start-learning-btn">Start Learning / teaching</a>
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