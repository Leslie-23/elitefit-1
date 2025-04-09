<?php
session_start();
include_once "../../../includes/datacon.php";

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../admin_login.php");
    exit();
}

// Handle Create
if (isset($_POST['create_user'])) {

    
    function clean_input($data) {
        return is_string($data) ? htmlspecialchars(stripslashes(trim($data))) : "";
    }

    // Collect user data
    $first_name = clean_input($_POST["first_name"]);
    $last_name = clean_input($_POST["last_name"]);
    $contact_number = clean_input($_POST["contact_number"]);
    $email = clean_input($_POST["email"]);
    $user_password = clean_input($_POST["user_password"]);
    $location = clean_input($_POST["location"]);
    $gender = clean_input($_POST["gender"]);
    $date_of_birth = clean_input($_POST["date_of_birth"]);
    $profile_picture = $_FILES["profile_picture"];

    $user_weight = clean_input($_POST["user_weight"]);
    $user_height = clean_input($_POST["user_height"]);
    $user_bodytype = clean_input($_POST["user_bodytype"]);
    $workout_1 = clean_input($_POST["preferred_workout_plan_1"]);
    $workout_2 = clean_input($_POST["preferred_workout_plan_2"]);
    $workout_3 = clean_input($_POST["preferred_workout_plan_3"]);

    $fitness_goal_1 = clean_input($_POST["fitness_goal_1"]);
    $fitness_goal_2 = clean_input($_POST["fitness_goal_2"]);
    $fitness_goal_3 = clean_input($_POST["fitness_goal_3"]);
    $experience_level = clean_input($_POST["experience_level"]);
    $health_condition = clean_input($_POST["health_condition"]);
    $health_condition_desc = isset($_POST["health_condition_desc"]) ? clean_input($_POST["health_condition_desc"]) : "";

    // Validate age
    $dob = date("Y-m-d", strtotime($date_of_birth));
    $age = date_diff(date_create($dob), date_create(date("Y-m-d")))->y;
    if ($age < 18 || $age > 69) {
        echo "<script>alert('User must be between 18 and 69 years of age');</script>";
        exit();
    }

    // Check duplicates
    $check_query = "SELECT * FROM user_register_details WHERE email='$email' OR contact_number='$contact_number'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Email or Contact Number already exists!');</script>";
        exit();
    }

    // Check workout uniqueness
    if ($workout_1 == $workout_2 || $workout_1 == $workout_3 || $workout_2 == $workout_3) {
        echo "<script>alert('Workout plans must be unique');</script>";
        exit();
    }

    // Handle profile picture
    if (!empty($profile_picture["name"])) {
        $target_dir = "uploads/";
        $profile_pic_name = basename($profile_picture["name"]);
        $target_file = $target_dir . time() . "_" . $profile_pic_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (!in_array($imageFileType, ["jpg", "jpeg", "png"])) {
            echo "<script>alert('Only JPG, JPEG, and PNG formats are allowed');</script>";
            exit();
        }
        if (!move_uploaded_file($profile_picture["tmp_name"], $target_file)) {
            echo "<script>alert('Failed to upload profile picture');</script>";
            exit();
        }
    } else {
        $target_file = "empty";
    }

    // Hash the user-supplied password
    $hashed_password = password_hash($user_password, PASSWORD_BCRYPT);

    // Insert into user_register_details
    $register_query = "INSERT INTO user_register_details (first_name, last_name, contact_number, email, location, gender, date_of_birth, profile_picture, user_password)
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($register_query);
    $stmt->bind_param("sssssssss", $first_name, $last_name, $contact_number, $email, $location, $gender, $dob, $target_file, $hashed_password);
    if (!$stmt->execute()) {
        echo "<script>alert('Registration failed: " . $stmt->error . "');</script>";
        exit();
    }
    $user_id = $stmt->insert_id;
    $stmt->close();

    // Insert into fitness details
    $fitness_query = "INSERT INTO user_fitness_details (table_id, user_weight, user_height, user_bodytype, preferred_workout_plan_1, preferred_workout_plan_2, preferred_workout_plan_3, fitness_goal_1, fitness_goal_2, fitness_goal_3, experience_level, health_condition, health_condition_desc)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt2 = $conn->prepare($fitness_query);
    $stmt2->bind_param("issssssssssss", $user_id, $user_weight, $user_height, $user_bodytype, $workout_1, $workout_2, $workout_3, $fitness_goal_1, $fitness_goal_2, $fitness_goal_3, $experience_level, $health_condition, $health_condition_desc);
    if (!$stmt2->execute()) {
        echo "<script>alert('Fitness info failed: " . $stmt2->error . "');</script>";
        exit();
    }
    $stmt2->close();

    // Insert into login table with same password
    $login_query = "INSERT INTO user_login_details (username, user_password) VALUES (?, ?)";
    $stmt3 = $conn->prepare($login_query);
    $stmt3->bind_param("ss", $email, $hashed_password);
    if (!$stmt3->execute()) {
        echo "<script>alert('Login creation failed: " . $stmt3->error . "');</script>";
        exit();
    }
    $stmt3->close();

    echo "<script>alert('User created successfully'); window.location.href='users.php';</script>";
}


// Handle Update
if (isset($_POST['update_user'])) {
    $user_id = $_POST['table_id'];
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $contact_number = trim($_POST['contact_number']);

    $stmt = $conn->prepare("UPDATE user_register_details SET first_name=?, last_name=?, email=?, contact_number=? WHERE table_id=?");
    $stmt->bind_param("ssssi", $first_name, $last_name, $email, $contact_number, $user_id);
    $stmt->execute();
    $stmt->close();
    // refresh the page
    echo "<script>alert('User updated successfully'); window.location.href='/'; window.location.href='users.php';</script>";
    header("Location: users.php");
    exit();
}

// Handle Delete
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $conn->query("DELETE FROM user_register_details WHERE id = $delete_id");
    header("Location: users.php");
    exit();
}

// Fetch all users
$users = $conn->query("SELECT * FROM user_register_details ORDER BY date_of_registration DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users | EliteFit Admin</title>
    <link rel="stylesheet" href="../../../css/users.css">
</head>
<body>
    <div class="admin-container">
        <h2 >All Registered Users</h2>
<div class="form-section">
     <button     onclick="window.location.href='addUsers.php'">Add User</button>
     <button    onclick="window.location.href='addUsers.php'">Delete User</button>
     </div>

        <!-- Display Table -->
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Registered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $sn = 1; while ($user = $users->fetch_assoc()): ?>
                <tr>
                    <td><?= $sn++; ?></td>
                    <td><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></td>
                    <td><?= htmlspecialchars($user['email']); ?></td>
                    <td><?= htmlspecialchars($user['contact_number']); ?></td>
                    <td><?= date("M d, Y", strtotime($user['date_of_registration'])); ?></td>
                    <td>
                        <!-- Update Form Toggle -->
                        <form method="POST" action="users.php" style="display:inline-block;">
                            <!-- <input type="hidden" name="table_id" value="<?= $user['id']; ?>"> -->
                            <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']); ?>" required>
                            <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']); ?>" required>
                            <input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
                            <input type="text" name="contact_number" value="<?= htmlspecialchars($user['contact_number']); ?>">
                            <button type="submit" name="update_user">Update</button>
                        </form>

                        <!-- Delete Button -->
                        <!-- <a href="users.php?delete=<?= $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a> -->
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
