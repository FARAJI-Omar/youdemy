<?php
require_once 'process/register.process.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="register-page">
    <?php include 'header.php'; ?>

    <div class="register-container">
        <div class="signup-form">
            <h2>Create Account</h2>

            <?php if (!empty($msg_error)): ?>
                <div class="error-message">
                <?php echo "<p style='color: red;'>" . htmlspecialchars($msg_error) . "</p>"; ?>
                </div>
            <?php endif; ?>

            <form action="" method="post">
                <div class="form-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email address" required>
                </div>

                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>

                <div class="form-group">
                    <i class="fas fa-person"></i>
                    <select name="role" id="role" required>
                        <option value="" disabled selected>Select Role</option>
                        <option value="student" >Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                </div>

                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
                </div>

                <button type="submit" name="register" class="register-btn">Create Account</button>
            </form>

            <div class="login-link">
                Already have an account? <a href="login.php">Login here</a>
            </div>
        </div>
    </div>
    <?php include 'footer.php';?>
</body>

</html>