<?php
session_start();
require_once '../classes/course.cl.php';

if (isset($_GET['course_id'])) {
    $course = new course();
    $course->delete_course($_GET['course_id']);

    if (isset($_SESSION['user_role'])) {
        switch ($_SESSION['user_role']) {
            case 'admin':
                header('Location: ../admin_dash_courses.php');
                break;
            case 'teacher':
                header('Location: ../teacher_dash_courses.php');
                break;
            case 'student':
                header('Location: ../student_dash_courses.php');
                break;
            default:
                header('Location: ../index.php');
        }
    } else {
        header('Location: ../index.php');
    }
    exit();
} else {
    header('Location: ../admin_dash_courses.php?error=invalid_request');
    exit();
}
