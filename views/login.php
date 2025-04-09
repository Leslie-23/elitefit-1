<?php
session_start();
if (isset($_SESSION['error'])) {
    echo "<p class='error-message'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EliteFit Login</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<div class="login-container">
    <h2>EliteFit Login</h2>
    <form action="../actions/login_process.php" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" style="margin-top: 10px;">Login</button>
        <p>Don't have an account? <a href="register.php">Sign up</a></p>
        <p>Login as <b>Admin</b><a href="./admin/admin_login.php">Here</a></p>
    </form>
</div>

</body>
</html>
