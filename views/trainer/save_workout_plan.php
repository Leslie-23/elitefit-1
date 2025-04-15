<?php
require '../../includes/datacon.php';
session_start();

if (!isset($_SESSION['trainer_id'])) {
    die("Access Denied. Trainer not logged in.<script>window.location.href = '../admin/admin_login.php';</script>");
}

$trainer_id = $_SESSION['trainer_id'];
$member_id = $_POST['member_id'];
$title = $_POST['plan_title'];
$desc = $_POST['plan_description'];

try {
    $conn->begin_transaction();

    $stmt = $conn->prepare("INSERT INTO workout_plans (trainer_id, member_id, plan_title, plan_description)
                            VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $trainer_id, $member_id, $title, $desc);
    $stmt->execute();
    $plan_id = $stmt->insert_id;

    $exercises = $_POST['exercise_name'];

    for ($i = 0; $i < count($exercises); $i++) {
        $stmt2 = $conn->prepare("INSERT INTO workout_exercises (plan_id, exercise_name, sets, reps, duration, intensity_level)
                                 VALUES (?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param("isiiis", $plan_id,
            $exercises[$i],
            $_POST['sets'][$i],
            $_POST['reps'][$i],
            $_POST['duration'][$i],
            $_POST['intensity_level'][$i]
        );
        $stmt2->execute();
    }

    $conn->commit();

    header("Location: trainer_dashboard.php");
    exit();
} catch (Exception $e) {
    $conn->rollback();
    echo "Failed to save plan: " . $e->getMessage();
}
?>
