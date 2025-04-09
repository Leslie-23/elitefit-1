<?php
require '../../includes/datacon.php';
session_start();

$trainer_id = $_SESSION['trainer_id'];
$member_id = $_POST['member_id'];
$title = $_POST['plan_title'];
$desc = $_POST['plan_description'];

$conn->beginTransaction();
$stmt = $conn->prepare("INSERT INTO workout_plans (trainer_id, member_id, plan_title, plan_description)
                        VALUES (?, ?, ?, ?)");
$stmt->execute([$trainer_id, $member_id, $title, $desc]);
$plan_id = $conn->lastInsertId();

$exercises = $_POST['exercise_name'];
for ($i = 0; $i < count($exercises); $i++) {
    $stmt2 = $conn->prepare("INSERT INTO workout_exercises (plan_id, exercise_name, sets, reps, duration, intensity_level)
                             VALUES (?, ?, ?, ?, ?, ?)");
    $stmt2->execute([
        $plan_id,
        $exercises[$i],
        $_POST['sets'][$i],
        $_POST['reps'][$i],
        $_POST['duration'][$i],
        $_POST['intensity_level'][$i]
    ]);
}
$conn->commit();

header("Location: trainer_dashboard.php?success=1");
exit();
