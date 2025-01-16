<?php
require_once 'classes/admin.cl.php';
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
            <h3 class="admin-name">Admin name</h3>
            <a href="#" onclick="showSection('manage-users')">Manage users</a>
            <a href="#" onclick="showSection('manage-content')">Manage content</a>
            <a href="#" onclick="showSection('statistics')">Statistics</a>
            <a href="process/logout.php" onclick="showSection('logout')">Logout</a>
        </aside>

        <div class="main-container">
            <div class="content-section" id="welcome">
                <h1>Welcome to the admin dashboard</h1>
            </div>
            <div class="content-section" id="manage-users">
                <h1>Manage users</h1>
                <div class="users_container">
                    <div class="students_container">
                        <h2>Students</h2>
                        <?php
                        $admin = new admin();
                        $admin->get_students();
                        ?>

                    </div>

                    <div class="teachers_container">
                        <h2>Teachers</h2>
                        <?php
                        $admin = new admin();
                        $admin->get_teachers();
                        ?>


                    </div>
                </div>
            </div>
            <div class="content-section" id="manage-content">
                <h1>Manage content</h1>
                <a href="#">Courses</a>
                <a href="#">Categories</a>
                <a href="#">Tags</a>
                <div class="content_container" id="courses_container">
                    <div class="">
                        <h2>Courses</h2>
                    </div>
                </div>
                <div class="content_container" id="categories_container">
                    <div class="">
                        <h2>Categories</h2>
                    </div>
                </div>
                <div class="content_container" id="tags_container">
                    <div class="">
                        <h2>Tags</h2>
                    </div>
                </div>
            </div>
            <div class="content-section" id="statistics">
                <h1>Statistics</h1>
            </div>
            <div class="content-section" id="logout">
                <h1>Logout</h1>
            </div>
        </div>
    </div>






    <?php include 'footer.php'; ?>
    <script>
        function showSection(section) {
            //hide all sections
            const sections = document.querySelectorAll('.content-section');
            const links = document.querySelectorAll('.content-section a');
            sections.forEach((sec) => {
                sec.style.display = 'none';
            });

            //show selected section
            document.getElementById(section).style.display = 'block';
        }

        //show welcome section by default
        showSection('welcome');
    </script>
</body>

</html>