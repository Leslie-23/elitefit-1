<?php
session_start();
include_once "../../includes/datacon.php"; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $email = trim($_POST['email']);
    $admin_password = trim($_POST['admin_password']);

    // Validate input
    if (empty($email) || empty($admin_password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: /elitefit-1/views/admin_login.php");
        exit();
    }

    // Prepare SQL query to get admin details
    $stmt = $conn->prepare("SELECT admin_id, first_name, last_name, email, admin_password, admin_role FROM admin_users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if admin exists
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashed_admin_password = $row['admin_password'];

        // Verify admin_password
        if (password_verify($admin_password, $hashed_admin_password)) {
            // Store admin session details
            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['admin_name'] = $row['first_name'] . ' ' . $row['last_name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_role'] = $row['admin_role'];
            
            // Update last login time
            $updateStmt = $conn->prepare("UPDATE admin_users SET last_login = NOW() WHERE admin_id = ?");
            $updateStmt->bind_param("i", $row['admin_id']);
            $updateStmt->execute();
            $updateStmt->close();

            header("Location: ../../views/admin/admin_dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid email or admin_password.";
        }
    } else {
        $_SESSION['error'] = "Admin not found.";
    }

    // Redirect back to login page with error
    header("Location: /elitefit-1/views/admin/admin_login.php");
    exit();
}
?>