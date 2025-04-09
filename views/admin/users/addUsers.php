<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users | EliteFit Admin</title>
    <link rel="stylesheet" href="../../../css/users.css">
</head>
<body>
    <div class="admin-container">
        <h2>Add New User</h2>

        <!-- Create User Form -->
        <div class="form-section">
            <h3>Create User</h3>
            <form method="POST" action="users.php">
            <input type="text" name="first_name" placeholder="First Name" required>
    <input type="text" name="last_name" placeholder="Last Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="contact_number" placeholder="Phone Number" required>
    <input type="text" name="location" placeholder="Location" required>
    <input type="password" name="user_password" placeholder="Password" required>
    <input type="text" name="gender" placeholder="Gender" required>
    <input type="date" name="date_of_birth" placeholder="Date of Birth" required>
    <input type="file" name="profile_picture" accept="image/*">

    <input type="text" name="user_weight" placeholder="Weight (kg)" required>
    <input type="text" name="user_height" placeholder="Height (cm)" required>
    <input type="text" name="user_bodytype" placeholder="Body Type" required>

    <input type="text" name="preferred_workout_plan_1" placeholder="Workout Plan 1" required>
    <input type="text" name="preferred_workout_plan_2" placeholder="Workout Plan 2" required>
    <input type="text" name="preferred_workout_plan_3" placeholder="Workout Plan 3" required>

    <input type="text" name="fitness_goal_1" placeholder="Fitness Goal 1" required>
    <input type="text" name="fitness_goal_2" placeholder="Fitness Goal 2" required>
    <input type="text" name="fitness_goal_3" placeholder="Fitness Goal 3" required>

    <input type="text" name="experience_level" placeholder="Experience Level" required>
    <input type="text" name="health_condition" placeholder="Health Condition" required>
    <input type="text" name="health_condition_desc" placeholder="Health Condition Description (if any)">

                <button type="submit" name="create_user">Create User</button>
            </form>
        </div>
</body>
</html>