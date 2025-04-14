<?php
session_start();
include('../../includes/datacon.php');

// Fetch trainers dynamically from trainer table
$trainerQuery = $conn->query("SELECT trainer_id, full_name FROM trainers"); // Assuming 'trainers' table
$trainers = [];
while ($row = $trainerQuery->fetch_assoc()) {
    $trainers[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $trainer_id = $_POST['trainer_id'];
    $session_date = $_POST['session_date'];
    $session_time = $_POST['session_time'];
    $session_type = $_POST['session_type'];

    $stmt = $conn->prepare("INSERT INTO trainer_sessions (user_id, trainer_id, session_date, session_time, session_type) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $user_id, $trainer_id, $session_date, $session_time, $session_type);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Session scheduled successfully!";
    } else {
        $_SESSION['error'] = "Error scheduling session.";
    }

    header("Location: schedule.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Schedule Session - EliteFit</title>
    <link rel="stylesheet" href="../../css/schedule.css">
</head>
<body>
<div class="login-container">
    <div class="login-header">
        <h1>Schedule a Session</h1>
        <p>Select your preferences to book with a trainer</p>
    </div>

    <form class="login-form" method="POST">
        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='error-message show' style='background-color:#d4edda;color:#155724;border-color:#c3e6cb'>" . $_SESSION['success'] . "</div>";
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo "<div class='error-message show'>" . $_SESSION['error'] . "</div>";
            unset($_SESSION['error']);
        }
        ?>
        <div class="form-group">
            <label for="trainer_id">Choose Trainer</label>
            <select name="trainer_id" id="trainer_id" required>
                <?php if (count($trainers) > 0): ?>
                    <?php foreach ($trainers as $trainer): ?>
                        <option value="<?= $trainer['trainer_id'] ?>"><?= htmlspecialchars($trainer['full_name']) ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option disabled>No trainers available at the moment</option>
                <?php endif; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="session_type">Session Type</label>
            <input type="text" name="session_type" id="session_type" placeholder="e.g., Cardio, Strength" required>
        </div>

        <div class="form-group">
            <label for="session_date">Date</label>
            <input type="date" name="session_date" required>
        </div>

        <div class="form-group">
            <label for="session_time">Time</label>
            <input type="time" name="session_time" required>
        </div>

        <button type="submit" class="login-btn">Book Session</button>
    </form>
</div>
</body>
</html>
