<?php
require_once '../classes/student.cl.php';
$student = new student();
$student->add_course($_GET['course_id'], $_SESSION['user_id']);
$msg = "Enrolled in course successfully";

header('Location: ../all_courses.php?message=' . $msg);
?>

