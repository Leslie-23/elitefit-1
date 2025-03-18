<?php
include_once "../includes/session.php";
include_once "../includes/datacon.php";

$first_name = $_SESSION['first_name'];
$table_id = $_SESSION['user_id'];

// Fetch user fitness details
$stmt = $conn->prepare("
    SELECT u.user_weight, u.user_height, u.user_bodytype, 
           u.preferred_workout_plan_1, u.preferred_workout_plan_2, u.preferred_workout_plan_3, 
           u.fitness_goal_1, u.fitness_goal_2, u.fitness_goal_3, 
           u.health_condition, u.experience_level, w1.workout_name AS plan1, 
           w2.workout_name AS plan2, w3.workout_name AS plan3
    FROM user_fitness_details u
    LEFT JOIN workout_plan w1 ON u.preferred_workout_plan_1 = w1.table_id
    LEFT JOIN workout_plan w2 ON u.preferred_workout_plan_2 = w2.table_id
    LEFT JOIN workout_plan w3 ON u.preferred_workout_plan_3 = w3.table_id
    WHERE u.table_id = ?
");
$stmt->bind_param("i", $table_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EliteFit Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script defer src="../js/script.js"></script>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <!-- <h2>EliteFit</h2> -->
            <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
        </div>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">My Workouts</a></li>
            <li><a href="#">Trainers</a></li>
            <li><a href="#">Progress</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
    <h2>Welcome, <?= htmlspecialchars($first_name, ENT_QUOTES, 'UTF-8') ?>!</h2>
        
        <div class="user-info">
            <h3>Your Fitness Stats</h3>
            <p><strong>Weight:</strong> <?= htmlspecialchars($user_data['user_weight']) ?> kg</p>
            <p><strong>Height:</strong> <?= htmlspecialchars($user_data['user_height']) ?> cm</p>
            <p><strong>Body Type:</strong> <?= htmlspecialchars($user_data['user_bodytype']) ?></p>
            
            <h3>Preferred Workout Plans</h3>
            <p><strong>Workout 1:</strong> <?= htmlspecialchars($user_data['plan1']) ?></p>
            <p><strong>Workout 2:</strong> <?= htmlspecialchars($user_data['plan2']) ?></p>
            <p><strong>Workout 3:</strong> <?= htmlspecialchars($user_data['plan3']) ?></p>

            <h3>Your Fitness Goals</h3>
            <p><?= htmlspecialchars($user_data['fitness_goal_1']) ?></p>
            <p><?= htmlspecialchars($user_data['fitness_goal_2']) ?></p>
            <p><?= htmlspecialchars($user_data['fitness_goal_3']) ?></p>

            <h3>Experience Level</h3>
            <p><?= htmlspecialchars($user_data['experience_level']) ?>/10</p>
            
            <h3>Health Condition</h3>
            <p><?= htmlspecialchars($user_data['health_condition']) ?></p>
        </div>
    </div
</body>
</html>
