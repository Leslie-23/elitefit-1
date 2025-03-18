<?php
session_start();
include_once "../includes/datacon.php"; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: /elitefit-1/views/login.php");
        exit();
    }

    // Prepare SQL query to get user details (Match email, not username)
    $stmt = $conn->prepare("
        SELECT ul.table_id, ul.username, ur.user_password 
        FROM user_login_details ul
        JOIN user_register_details ur ON ul.table_id = ur.table_id
        WHERE ul.username = ?
    ");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['user_password'];

        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Store user session details
            $_SESSION['user_id'] = $row['table_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['table_id'] = $row['table_id']; // Ensure consistency

            header("Location: ../views/dashboard.php"); // Absolute path
            exit();
        } else {
            $_SESSION['error'] = "Invalid email or password.";
        }
    } else {
        $_SESSION['error'] = "User not found.";
    }

    // Redirect back to login page with error
    header("Location: /elitefit-1/views/login.php");
    exit();
}
?>
