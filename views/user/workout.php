<?php
include_once "../../includes/session.php";
include_once "../../includes/datacon.php";

$table_id = $_SESSION['user_id'] ?? 0;

// Handle update if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs with null coalescing to avoid undefined index
    $plan1 = isset($_POST['preferred_workout_plan_1']) ? intval($_POST['preferred_workout_plan_1']) : null;
    $plan2 = isset($_POST['preferred_workout_plan_2']) ? intval($_POST['preferred_workout_plan_2']) : null;
    $plan3 = isset($_POST['preferred_workout_plan_3']) ? intval($_POST['preferred_workout_plan_3']) : null;
    $goal1 = isset($_POST['fitness_goal_1']) ? trim($_POST['fitness_goal_1']) : '';
    $goal2 = isset($_POST['fitness_goal_2']) ? trim($_POST['fitness_goal_2']) : '';
    $goal3 = isset($_POST['fitness_goal_3']) ? trim($_POST['fitness_goal_3']) : '';
    $health = isset($_POST['health_condition']) ? trim($_POST['health_condition']) : '';

    // Validate essential data
    if ($plan1 && $goal1 && $goal2 && $goal3) {
        $stmt = $conn->prepare("
            UPDATE user_fitness_details 
            SET preferred_workout_plan_1 = ?, 
                preferred_workout_plan_2 = ?, 
                preferred_workout_plan_3 = ?, 
                fitness_goal_1 = ?, 
                fitness_goal_2 = ?, 
                fitness_goal_3 = ?, 
                health_condition = ?
            WHERE table_id = ?
        ");
        $stmt->bind_param("iiissssi", $plan1, $plan2, $plan3, $goal1, $goal2, $goal3, $health, $table_id);
                                          
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: workout.php");
            exit;
        } else {
            $error_message = "Failed to update profile. Please try again.";
        }
        $stmt->close();
    } else {
        $error_message = "Please fill all required fields.";
    }
}

// FETCH current fitness data
$stmt = $conn->prepare("
    SELECT u.health_condition, u.fitness_goal_1, u.fitness_goal_2, u.fitness_goal_3,
           u.preferred_workout_plan_1, u.preferred_workout_plan_2, u.preferred_workout_plan_3,
           w1.workout_name AS plan1_name, w2.workout_name AS plan2_name, w3.workout_name AS plan3_name
    FROM user_fitness_details u
    LEFT JOIN workout_plan w1 ON u.preferred_workout_plan_1 = w1.table_id
    LEFT JOIN workout_plan w2 ON u.preferred_workout_plan_2 = w2.table_id
    LEFT JOIN workout_plan w3 ON u.preferred_workout_plan_3 = w3.table_id
    WHERE u.table_id = ?
");
$stmt->bind_param("i", $table_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc() ?? [];
$stmt->close();

// FETCH available workout plans
$plans_result = $conn->query("SELECT table_id, workout_name FROM workout_plan ORDER BY workout_name");
$workout_options = [];
while ($row = $plans_result->fetch_assoc()) {
    $workout_options[] = $row;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Fitness Preferences</title>
    <link rel="stylesheet" href="../../css/workout.css">
</head>
<body>
<div class="content">
    <h2>Update Your Fitness Plan & Health Info</h2>

    <?php if (!empty($error_message)): ?>
        <div style="color: red;"><?= htmlspecialchars($error_message) ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <fieldset>
            <legend>Workout Plans</legend>
            <label>Primary Plan:</label>
            <select name="preferred_workout_plan_1" required>
                <?php foreach ($workout_options as $plan): ?>
                    <option value="<?= $plan['table_id'] ?>" <?= $plan['table_id'] == ($user_data['preferred_workout_plan_1'] ) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($plan['workout_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Secondary Plan:</label>
            <select name="preferred_workout_plan_2">
                <?php foreach ($workout_options as $plan): ?>
                    <option value="<?= $plan['table_id'] ?>" <?= $plan['table_id'] == ($user_data['preferred_workout_plan_2'] ) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($plan['workout_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Tertiary Plan:</label>
            <select name="preferred_workout_plan_3">
                <?php foreach ($workout_options as $plan): ?>
                    <option value="<?= $plan['table_id'] ?>" <?= $plan['table_id'] == ($user_data['preferred_workout_plan_3'] ) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($plan['workout_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </fieldset>

        <fieldset>
            <legend>Fitness Goals</legend>
            <input type="text" name="fitness_goal_1" value="<?= htmlspecialchars($user_data['fitness_goal_1'] ) ?>" placeholder="Fitness Goal 1" required>
            <input type="text" name="fitness_goal_2" value="<?= htmlspecialchars($user_data['fitness_goal_2'] ) ?>" placeholder="Fitness Goal 2" required>
            <input type="text" name="fitness_goal_3" value="<?= htmlspecialchars($user_data['fitness_goal_3'] ) ?>" placeholder="Fitness Goal 3" required>
        </fieldset>

        <fieldset>
            <legend>Health Condition</legend>
            <textarea name="health_condition" rows="4" placeholder="Enter any health concerns..."><?= htmlspecialchars($user_data['health_condition'] ) ?></textarea>
        </fieldset>

        <button type="submit">Save Changes</button>
    </form>
</div>
</body>
</html>
