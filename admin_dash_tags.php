<?php
require_once 'classes/admin.cl.php';
require_once 'classes/user.cl.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <title>Document</title>
</head>

<body>
    <div class="admin-header">
        <?php include 'header.php'; ?>
    </div>

    <div class="admin_body">
        <aside>
            <img src="img/User profile.png" class="admin-profile">
            <a href="admin_dashboard.php" style="text-decoration: none;"><h3 class="admin-name"><?php echo $_SESSION['username'];?></h3></a>
            <a href="admin_manage_users.php">Manage users</a>
            <a href="admin_manage_content.php">Manage content</a>
            <a href="process/logout.php">Logout</a>
        </aside>

        <div class="main-container">
            <div class="content-section" id="manage-content">
                <h1>Manage content</h1>
                <div class="content_links">
                    <a href="admin_dash_courses.php">Courses</a>
                    <a href="admin_dash_categories.php">Categories</a>
                    <a href="admin_dash_tags.php" id="tags">Tags</a>
                </div>
                <div class="content_container" id="courses_container">
                    <div class="tags_container">
                        <div class="add_tags_section">
                            <h3>Add Tag</h3>
                            <form action="process/create_tag.process.php" method="POST" class="add_tag_form">
                                <input type="text" name="tag_name" placeholder="Enter tag name..." class="add_tag_input" autofocus>
                                <input value="Add Tags" href="process/create_tag.process.php" type="submit" class="add_tags_btn">
                            </form>
                        </div>
                        <div class="add_tags_section">
                            <h3>Delete tag</h3>
                            <div class="tags-list delete-mode">
                            <?php
                                $admin = new admin();
                                $tags = $admin->get_tags();
                                ?>
                            </div>
                        </div>
                        

                    </div>
                </div>
              
            </div>
      
        </div>
    </div>






    <?php include 'footer.php'; ?>

    <script>
        var input = document.querySelector('input[name="tag_name"]');
        new Tagify(input);
    </script>
</body>

</html>