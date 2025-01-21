<?php
require_once 'classes/course.cl.php';
require_once 'classes/student.cl.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>All Courses</title>
</head>
<body>
<div class="admin-header">
    <?php include 'header.php'; ?>
</div>
<div class="all_courses_container">
    <div class="course_details">
   <?php
        $course = new course();
        $course->get_course_details($_GET['course_id']);
        ?>  
    </div>


        
</div>
<?php include 'footer.php'; ?>
</body>

</html>
    

</body>
</html>