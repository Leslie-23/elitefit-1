<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <form action="../../actions/admin_actions/admin_register_process.php" method="POST" enctype="multipart/form-data">
        <h2 >Register New Admin </h2>
        
        <label>First Name:</label><br>
        <input type="text" name="first_name" required><br><br>

        <label>Last Name:</label><br>
        <input type="text" name="last_name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Phone Number:</label><br>
        <input type="text" name="phone_number" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="admin_password" required><br><br>

        <label>Role:</label><br>
        <select name="admin_role" required>
            <option value="super_admin">Super Admin</option>
            <option value="equipment_manager">Manager</option>
            <option value="admin">admin</option>
        </select><br><br>

        <label>Profile Picture:</label><br>
        <input type="file" name="profile_picture" accept="image/*"><br><br>

        <button type="submit">Register Admin</button>
    </form>
</body>
</html>
