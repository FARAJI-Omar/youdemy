<?php
require_once 'classes/course.cl.php';
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
    <title>Course Content</title>
</head>

<body>
    <div class="admin-header">
        <?php include 'header.php'; ?>
    </div>
    <div class="all_courses_container">
        <div class="course_content">
            <?php
            $student = new student();
            $course_id = $_GET['course_id'];
            $content = $student->get_course_content($course_id);

            if ($content) {
                echo "<h1>" . htmlspecialchars($content['title']) . "</h1>";
                if (!empty($content['video_content'])) {
                    echo "<iframe src='" . htmlspecialchars($content['video_content']) . "' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
                } elseif (!empty($content['text_content'])) {
                    echo "<p>" . htmlspecialchars($content['text_content']) . "</p>";
                } else {
                    echo "<p>No content available for this course.</p>";
                }
            } else {
                echo "<p>Course not found.</p>";
            }
            ?>
        </div>



    </div>
    <?php include 'footer.php'; ?>
</body>

</html>


</body>

</html>