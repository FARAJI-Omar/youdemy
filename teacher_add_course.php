<?php
require_once 'classes/user.cl.php';
require_once 'classes/teacher.cl.php';
$error_message = "";

if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}elseif(isset($_SESSION['user_id'])){
    if($_SESSION['user_role'] !== 'teacher'){
        header("location: index.php");
    }
}
?>

<?php
if (isset($_GET['message'])) {
    echo "<div class='message_box'>" . htmlspecialchars($_GET['message']) . "</div>";
    //add a delay of 2 seconds and remove the message
    echo "<script>setTimeout(() => { window.location.href = 'teacher_add_course.php'; }, 3000);</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <title>Teacher Dashboard</title>
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
            <a href="process/logout.php">Logout</a>
        </aside>

        <div class="main-container">
            <div class="content-section" id="welcome">
                <h1>Create a new course</h1>
                <p class="create_course_text">Fill in the details below to create a new course</p>

                    <form action="process/teacher_add_course.process.php" method="post" class="create_course_form">

                    <input type="text" name="title" placeholder="Course title" required>

                    <textarea type="text" name="description" placeholder="Course description" required></textarea>

                    <input type="url" name="image" id="image" placeholder="Course image URL" required>

                    <select name="category" id="category" required>
                        <option value="0">Select a category</option>
                        <?php
                        $teacher = new Teacher();
                        $teacher->get_categories();
                        ?>
                    </select>

                    <select id="tags" name="tags[]" multiple required>
                        <?php
                        $teacher = new Teacher();
                        $teacher->get_tags();
                        ?>
                    </select>

                    <select name="course-type" id="course-type" onchange="showInput(this.value)" required>
                        <option value="0" disabled selected>Course Type</option>
                        <option value="video">Video Course</option>
                        <option value="text">Text Course</option>
                    </select>

                    <div id="video-input" style="display: none;">
                        <input type="url" name="video-url" placeholder="Video URL" style="width: 100%;">
                        <?php if (isset($error_message)) {
                            echo "<p class='error-message'>$error_message</p>";
                        } ?>
                    </div>

                    <div id="text-input" style="display: none;">
                        <textarea type="text" name="text_course" placeholder="Enter text here" style="width: 100%; height: 200px;"></textarea>
                    </div>
                    <div class="create_course_btn">
                        <a href="teacher_add_course.php" class="create_course_btn">Cancel</a>
                        <input type="submit" name="create_course" value="Create course">
                    </div>
                    </form>                
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script>
        function showInput(value) {
            var videoInput = document.getElementById('video-input');
            var textInput = document.getElementById('text-input');

            if (value === 'video') {
                videoInput.style.display = 'flex';
                textInput.style.display = 'none';
            } else if (value === 'text') {
                videoInput.style.display = 'none';
                textInput.style.display = 'flex';
            } else {
                videoInput.style.display = 'none';
                textInput.style.display = 'none';
            }
        }
        // choices.js
        const tagsSelect = new Choices("#tags", {
            removeItemButton: true, // Allow removing selected tags
            placeholder: true,
            placeholderValue: "Select tags",
            searchPlaceholderValue: "Search tags"
        });
    </script>
</body>

</html>