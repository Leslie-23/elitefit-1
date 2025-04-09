<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EliteFit Login</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Roboto&display=swap" rel="stylesheet">
</head>
<body>

<div class="login-container">
    
    <!-- Header Section -->
    <div class="login-header">
        <h1>EliteFit</h1>
        <p>Welcome back! Please login to your account.</p>
    </div>

    <!-- Login Form -->
    <form class="login-form" action="../actions/login_process.php" method="POST">
        
        <!-- Error Message Display -->
        <?php
        if (isset($_SESSION['error'])) {
            echo "<div class='error-message show'>" . $_SESSION['error'] . "</div>";
            unset($_SESSION['error']);
        }
        ?>

        <!-- Email Field -->
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>

        <!-- Password Field -->
        <div class="form-group password-input">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="login-btn">Login</button>

        <!-- Footer Links -->
        <div class="form-footer">
            <p>Don't have an account? <a href="register.php">Sign up</a></p>
            <p>Login as <strong>Admin</strong> <a href="./admin/admin_login.php">Here</a></p>
        </div>
    </form>
</div>

</body>
</html>
