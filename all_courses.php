<?php
require_once 'classes/user.cl.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 6;
$user = new user();
$total_courses = $user->get_total_courses();

$total_pages = ceil($total_courses / $limit);

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
            $user = new user();
            $user->get_courses($page, $limit);
            ?>
        </div>

        <!-- pagination controls -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="all_courses.php?page=<?php echo $page - 1; ?>">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="all_courses.php?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <a href="all_courses.php?page=<?php echo $page + 1; ?>">Next</a>
            <?php endif; ?>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>