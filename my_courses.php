<?php
require_once 'classes/student.cl.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>My Courses</title>
</head>
<body>
<div class="admin-header">
    <?php include 'header.php'; ?>
</div>
<div class="">
<div class="all_courses_container">
    <?php
        $student = new student();
        $student->get_my_courses($_SESSION['user_id']);
    ?>
    </div>


        
</div>
<?php include 'footer.php'; ?>
</body>

</html>
    

</body>
</html>