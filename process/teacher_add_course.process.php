<?php
require_once '../classes/teacher.cl.php';
require_once '../classes/login.cl.php';

if (isset($_POST['course-type']) && !empty($_POST['course-type']) && !empty($_POST['category']) && !empty($_POST['tags'])) {
    $teacher = new Teacher();
    if ($_POST['course-type'] == 'video') {
        $teacher->add_course($_POST['title'], $_POST['description'], $_POST['category'], $_POST['tags'], $_SESSION['username'], $_POST['video-url'], null);
        $message = "Course added successfully";
        header("Location: ../teacher_add_course.php?message=$message");
        exit();
    } else {
        $teacher->add_course($_POST['title'], $_POST['description'], $_POST['category'], $_POST['tags'], $_SESSION['username'], null, $_POST['pdf-url']);
        $message = "Course added successfully";
        header("Location: ../teacher_add_course.php?message=$message");
        exit();
    }
} else {
    $message = "Course addition failed";
}
header("Location: ../teacher_add_course.php?message=$message");
exit();
