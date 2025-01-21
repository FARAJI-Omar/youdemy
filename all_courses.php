<?php
require_once 'classes/student.cl.php';
?>

<?php
if (isset($_GET['message'])) {
    echo "<div class='message_box'>" . htmlspecialchars($_GET['message']) . "</div>";
    //add a delay of 3 seconds and remove the message
    echo "<script>setTimeout(() => { window.location.href = 'all_courses.php'; }, 3000);</script>";
}
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
<div class="">
<div class="all_courses_container">
    <?php
        $student = new student();
        $student->get_courses();
        ?>
    </div>


        
</div>
<?php include 'footer.php'; ?>
</body>

</html>
    

</body>
</html>