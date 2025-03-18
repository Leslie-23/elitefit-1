<?php
include_once "datacon.php";
session_start();

if (!isset($_SESSION['user_id'])) { // Ensure variable name matches login session
    header("Location: /elitefit-1/views/login.php"); // Use absolute path
    exit();
}



if (!isset($_SESSION['first_name'])) {
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT first_name FROM user_register_details WHERE table_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $_SESSION['first_name'] = $row['first_name'];
    }

    $stmt->close();
}
?>