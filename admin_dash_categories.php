<?php
require_once 'classes/admin.cl.php';
require_once 'classes/login.cl.php';
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
            <a href="admin_statistics.php">Statistics</a>
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
                            <h3>All Categories</h3>
                            <div class="categories-list">
                                <?php
                                $admin = new admin();
                                $categories = $admin->get_categories();
                                if ($categories) {
                                    foreach ($categories as $category) {
                                        echo '<span class="category-tag">' . $category['category_name'] . '</span>';
                                    }
                                } else {
                                    echo '<p class="no-categories">No categories found</p>';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="categories-section">
                            <h3>Add Category</h3>
                            <form action="process/create_category.process.php" method="POST" class="add-category-form">
                                <input type="text" name="category_name" placeholder="Enter category name..." required>
                                <button type="submit" class="add-btn">Add Category</button>
                            </form>
                        </div>

                        <div class="categories-section">
                            <h3>Delete Categories</h3>
                            <div class="categories-list delete-mode">
                                <?php
                                if ($categories) {
                                    foreach ($categories as $category) {
                                        echo '<div class="category_tag_delete">';
                                        echo '<span class="category_tag_d">' . $category['category_name'] .
                                            '<a href="process/delete_category.process.php?category_id=' . $category['category_id'] . '" id="delete_cat_btn">×</a></span>';
                                        echo '</div>';
                                    }
                                } else {
                                    echo '<p class="no-categories">No categories to delete</p>';
                                }
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