<?php
session_start();
include('../../includes/datacon.php');

// If you want trainer to see ALL sessions, remove the session filter.
// If you still want only THEIR sessions, ensure the trainer_id is set correctly.
$trainer_id = $_SESSION['trainer_id'] ?? 1; // Replace 1 with actual login default or error handling

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_session'])) {
    $session_id = $_POST['session_id'];
    $new_status = $_POST['status'];
    $session_type = $_POST['session_type'];
    $session_date = $_POST['session_date'];
    $session_time = $_POST['session_time'];

    $stmt = $conn->prepare("UPDATE trainer_sessions SET status=?, session_type=?, session_date=?, session_time=? WHERE session_id=?");
    $stmt->bind_param("ssssi", $new_status, $session_type, $session_date, $session_time, $session_id);

    //  $total_sessions = SELECT COUNT(*) FROM trainer_sessions WHERE trainer_id = $trainer_id;
    if ($stmt->execute()) {
        $_SESSION['success'] = "Session updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update session.";
    }
    
    header("Location: trainer_dashboard.php");
    exit();
}

// Fetch ALL scheduled sessions
$stmt = $conn->prepare("
    SELECT s.*, u.first_name, u.last_name 
    FROM trainer_sessions s 
    JOIN user_register_details u ON s.user_id = u.table_id 
    ORDER BY s.session_date, s.session_time
");
$stmt->execute();
$result = $stmt->get_result();

$total_sessions = $conn->prepare("SELECT COUNT(*) FROM trainer_sessions");
$total_sessions->execute();
$total_sessions = $total_sessions->get_result()->fetch_row()[0];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Trainer Dashboard - EliteFit</title>
    <link rel="stylesheet" href="../../css/trainer_dashboard.css">
</head>
<body>
<div class="login-container">
    <div class="login-header">
        <h1>Trainer Dashboard</h1>
        <p>Manage and review your scheduled sessions</p>
        <p>Total sessions scheduled: <?php echo $total_sessions; ?></p>
    </div>

    <div class="login-form">
        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='error-message show' style='background-color:#d4edda;color:#155724;border-color:#c3e6cb'>" . htmlspecialchars($_SESSION['success']) . "</div>";
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo "<div class='error-message show'>" . htmlspecialchars($_SESSION['error']) . "</div>";
            unset($_SESSION['error']);
        }
        ?>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <form method="POST" class="form-group" style="border-bottom: 1px solid #ccc; padding-bottom: 10px; margin-bottom: 20px;">
                    <input type="hidden" name="session_id" value="<?= intval($row['session_id']) ?>">

                    <label><strong>Member:</strong> <?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></label><br>

                    <label>Session Type</label>
                    <input type="text" name="session_type" value="<?= htmlspecialchars($row['session_type']) ?>" required>

                    <label>Date</label>
                    <input type="date" name="session_date" value="<?= htmlspecialchars($row['session_date']) ?>" required>

                    <label>Time</label>
                    <input type="time" name="session_time" value="<?= htmlspecialchars($row['session_time']) ?>" required>

                    <label>Status</label>
                    <select name="status" required>
                        <?php
                        $statuses = ['Pending', 'Confirmed', 'Completed', 'Cancelled'];
                        foreach ($statuses as $status) {
                            $selected = ($row['status'] === $status) ? 'selected' : '';
                            echo "<option value='$status' $selected>$status</option>";
                        }
                        ?>
                    </select>

                    <button type="submit" name="update_session" class="login-btn" style="margin-top:10px;">Update Session</button>
                </form>
            <?php endwhile; ?>
        <?php else: ?>
            <div style="text-align:center; padding:20px;">
                <p>No sessions scheduled yet.</p>
                <p style="color:#555;">Await client bookings or <a href="create_session.php">manually schedule a session</a>.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
