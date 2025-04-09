<?php
include_once "../../includes/datacon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function clean_input($data) {
        return is_string($data) ? htmlspecialchars(stripslashes(trim($data))) : "";
    }

    // Collecting Input Data
    $first_name = clean_input($_POST["first_name"]);
    $last_name = clean_input($_POST["last_name"]);
    $email = clean_input($_POST["email"]);
    $phone_number = clean_input($_POST["phone_number"]);
    $admin_password = clean_input($_POST["admin_password"]);
    $admin_role = clean_input($_POST["admin_role"]);
    $profile_picture = $_FILES["profile_picture"];

    // Check for existing email or user
    $check_query = "SELECT * FROM admin_users WHERE email='$email' OR first_name='$first_name'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Email or User already exists!'); window.history.back();</script>";
        exit();
    }

    // Upload Profile Picture
    if (!empty($profile_picture["name"])) {
        $target_dir = "uploads/admin_profiles/";
        $profile_pic_name = basename($profile_picture["name"]);
        $target_file = $target_dir . time() . "_" . $profile_pic_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (!in_array($imageFileType, ["jpg", "jpeg", "png"])) {
            echo "<script>alert('Only JPG, JPEG, and PNG files are allowed!'); window.history.back();</script>";
            exit();
        }

        if (!move_uploaded_file($profile_picture["tmp_name"], $target_file)) {
            echo "<script>alert('Profile picture upload failed!'); window.history.back();</script>";
            exit();
        }
    } else {
        $target_file = NULL;
    }

    // Securely hash the password
    $hashed_password = password_hash($admin_password, PASSWORD_BCRYPT);

    // Insert Admin Details
    $insert_query = "INSERT INTO admin_users (first_name, last_name, email, phone_number, admin_password, admin_role, profile_picture, created_at)
                     VALUES ('$first_name', '$last_name', '$email', '$phone_number', '$hashed_password', '$admin_role', '$target_file', NOW())";

    if (!mysqli_query($conn, $insert_query)) {
        echo "<script>alert('Registration failed: " . mysqli_error($conn) . "'); window.history.back();</script>";
        exit();
    }

    echo "<script>alert('Admin account successfully registered!'); window.location.href='../../views/admin/admin_login.php';</script>";
}
// $_SESSION['admin_email'] = $row['email'];
$_SESSION['admin_role'] = $row['admin_role'];
?>
