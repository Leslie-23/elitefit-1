<?php
session_start();
include('../../includes/datacon.php');

$trainer_id = $_SESSION['trainer_id'] ?? 1; // Default or from login session

// Update session status or details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_session'])) {
    $session_id = $_POST['session_id'];
    $new_status = $_POST['status'];
    $session_type = $_POST['session_type'];
    $session_date = $_POST['session_date'];
    $session_time = $_POST['session_time'];

    $stmt = $conn->prepare("UPDATE trainer_sessions SET status=?, session_type=?, session_date=?, session_time=? WHERE id=? AND trainer_id=?");
    $stmt->bind_param("ssssii", $new_status, $session_type, $session_date, $session_time, $session_id, $trainer_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Session updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update session.";
    }

    header("Location: trainer_dashboard.php");
    exit();
}

$result = $conn->query("
    SELECT s.*, u.first_name, u.last_name 
    FROM trainer_sessions s 
    JOIN user_register_details u ON s.user_id = u.table_id 
    WHERE s.trainer_id = ?
    ORDER BY s.session_date, s.session_time
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Trainer Dashboard - EliteFit</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
<div class="login-container">
    <div class="login-header">
        <h1>Trainer Dashboard</h1>
        <p>Manage and review scheduled sessions</p>
    </div>

    <div class="login-form">
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

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <form method="POST" class="form-group" style="border-bottom: 1px solid #ccc; padding-bottom: 10px; margin-bottom: 20px;">
                    <input type="hidden" name="session_id" value="<?= $row['id'] ?>">
                    <label><strong>Member:</strong> <?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></label><br>
                    
                    <label>Session Type</label>
                    <input type="text" name="session_type" value="<?= htmlspecialchars($row['session_type']) ?>" required>
                    
                    <label>Date</label>
                    <input type="date" name="session_date" value="<?= $row['session_date'] ?>" required>

                    <label>Time</label>
                    <input type="time" name="session_time" value="<?= $row['session_time'] ?>" required>

                    <label>Status</label>
                    <select name="status" required>
                        <option value="Pending" <?= $row['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="Confirmed" <?= $row['status'] === 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                        <option value="Completed" <?= $row['status'] === 'Completed' ? 'selected' : '' ?>>Completed</option>
                        <option value="Cancelled" <?= $row['status'] === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                    </select>

                    <button type="submit" name="update_session" class="login-btn" style="margin-top:10px;">Update Session</button>
                </form>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No sessions scheduled yet.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
