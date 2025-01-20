<?php
require_once '../classes/teacher.cl.php';
require_once '../classes/user.cl.php';

$course_id = $_GET['course_id'];

//validate image URL
$image_valid = false;
if (!empty($_POST['image'])) {
    //get the file extension
    if (filter_var($_POST['image'], FILTER_VALIDATE_URL)) {
        $extension = strtolower(pathinfo($_POST['image'], PATHINFO_EXTENSION));
        //check if the extension is png, jpg, jpeg
        if (in_array($extension, ['png', 'jpg', 'jpeg'])) {
            $image_valid = true;
        }
    }
}

if (!$image_valid) {
    $message = "Invalid image URL. Please provide a valid image URL (.png, .jpg, or .jpeg).";
    header("Location: ../teacher_add_course.php?message=$message");
    exit();  
} 

//validate text_course input
if ($_POST['course-type'] == 'text') {
    $textCourse = htmlspecialchars(trim($_POST['text_course']));
    if (empty($textCourse)) {
        $message = "Text course content cannot be empty.";
        header("Location: ../teacher_add_course.php?message=$message");
        exit();
    }
}

if (isset($_POST['course-type']) 
    && !empty($_POST['course-type']) 
    && !empty($_POST['category'])
    && !empty($_POST['image'])
    && !empty($_POST['tags'])){

    $teacher = new Teacher();

    if ($_POST['course-type'] == 'video') {
        if (!filter_var($_POST['video-url'], FILTER_VALIDATE_URL)) {
            $message = "Invalid video URL.";
            header("Location: ../teacher_add_course.php?message=$message");
            exit();

        } else {
            $teacher->edit_course($course_id, 
            $_POST['title'], 
            $_POST['description'],
            $_POST['category'], 
            $_POST['image'],
            $_POST['tags'], 
            $_SESSION['username'], 
            $_POST['video-url'], 
            null);

            $message = "Course modified successfully";
            header("Location: ../teacher_add_course.php?message=$message");
            exit();
        }
    } elseif ($_POST['course-type'] == 'text') {
        $teacher->edit_course($course_id, 
                            $_POST['title'], 
                            $_POST['description'], 
                            $_POST['image'],
                            $_POST['category'], 
                            $_POST['tags'], 
                            $_SESSION['username'], 
                            null, 
                            $_POST['text_course']);

        $message = "Course modified successfully";
        header("Location: ../teacher_add_course.php?message=$message");
        exit();
    }
} else {
    $message = "Course modification failed";
}

header("Location: ../teacher_add_course.php?message=$message");
exit();
