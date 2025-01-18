<?php
session_start();
require_once '../classes/user.cl.php';

if (isset($_GET['course_id'])) {
    $user = new user();
    $user->delete_course($_GET['course_id']);

    if (isset($_SESSION['user_role'])) {
        switch ($_SESSION['user_role']) {
            case 'admin':
                $message = "Course deleted successfully";
                header("Location: ../admin_dash_courses.php?message=$message");
                break;
            case 'teacher':
                $message = "Course deleted successfully";
                header('Location: ../teacher_dash_courses.php');
                break;
            case 'student':
                $message = "Course deleted successfully";
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
    $message = "Invalid request";
    header("Location: ../admin_dash_courses.php?message=$message");
    exit();
}
