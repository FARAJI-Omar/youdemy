<?php
require_once 'process/login.process.php';
?>
    
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="register-page">
    <?php include 'header.php'; ?>

    <div class="register-container">
        <div class="signup-form">
            <h2>Sign             in</h2>

            <?php if (!empty($msg_error)): ?>
                <div class="error-message">
                    <?= htmlspecialchars($msg_error); ?>
                </div>
            <?php endif; ?>

            <form action="" method="post">
                <div class="form-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email address" required>
                </div>

                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit" name="login" class="register-btn">Sign in</button>
            </form>

            <div class="login-link">
                Dont have an account? <a href="register.php">Create an account</a>
            </div>
        </div>
    </div>
    <?php include 'footer.php';?>
</body>

</html>