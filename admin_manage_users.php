<?php
require_once 'classes/admin.cl.php';
require_once 'classes/login.cl.php';
?>

<?php 
// Display the message if set
if (isset($_GET['message'])) {
    echo "<div class='message_box'>" . htmlspecialchars($_GET['message']) . "</div>";
    //add a delay of 2 seconds and remove the message
    echo "<script>setTimeout(() => { window.location.href = 'admin_manage_users.php'; }, 2000);</script>";
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
            <a href="admin_dashboard.php" style="text-decoration: none;"><h3 class="admin-name"><?php echo $_SESSION['username'];?></h3></a>
            <a href="admin_manage_users.php">Manage users</a>
            <a href="admin_manage_content.php">Manage content</a>
            <a href="admin_statistics.php">Statistics</a>
            <a href="process/logout.php">Logout</a>
        </aside>

        <div class="main-container">
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
        </div>
    </div>






    <?php include 'footer.php'; ?>
    <script>
        function showSection(section) {
            //hide all sections
            const sections = document.querySelectorAll('.content-section');
            sections.forEach((sec) => {
                sec.style.display = 'none';
            });

            //show selected section
            document.getElementById(section).style.display = 'block';
        }

        //show welcome section by default
        showSection('manage-users');
    </script>
</body>

</html>