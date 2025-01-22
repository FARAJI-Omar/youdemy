<?php
require_once 'classes/admin.cl.php';
require_once 'classes/user.cl.php';
?>

<?php 
// Display the message if set
if (isset($_GET['message'])) {
    echo "<div class='message_box'>" . htmlspecialchars($_GET['message']) . "</div>";
    //add a delay of 2 seconds and remove the message
    echo "<script>setTimeout(() => { window.location.href = 'admin_dash_categories.php'; }, 2000);</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>

<body>
    <div class="admin-header">
        <?php include 'header.php'; ?>
    </div>

    <div class="admin_body">
        <aside>
            <img src="img/User profile.png" class="admin-profile">
            <a href="admin_dashboard.php" style="text-decoration: none;">
                <h3 class="admin-name"><?php echo $_SESSION['username']; ?></h3>
            </a>
            <a href="admin_manage_users.php">Manage users</a>
            <a href="admin_manage_content.php">Manage content</a>
            <a href="process/logout.php">Logout</a>
        </aside>

        <div class="main-container">
            <div class="content-section" id="manage-content">
                <h1>Manage content</h1>
                <div class="content_links">
                    <a href="admin_dash_courses.php">Courses</a>
                    <a href="admin_dash_categories.php" id="categories">Categories</a>
                    <a href="admin_dash_tags.php">Tags</a>
                </div>
                <div class="content_container" id="courses_container">
                    <div class="categories-container">
                        <div class="categories-section">
                            <h3>Add Category</h3>
                            <form action="process/create_category.process.php" method="POST" class="add-category-form">
                                <input type="text" name="category_name" placeholder="Enter category name..." class="add_category_input" required>
                                <input value="Add Category" href="process/create_category.process.php" type="submit" class="add_btn">
                            </form>
                        </div>

                        <div class="categories-section">
                            <h3>Delete Category</h3>
                            <div class="categories-list delete-mode">
                            <?php
                                $admin = new admin();
                                $categories = $admin->get_categories();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>