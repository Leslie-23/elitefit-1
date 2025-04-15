<?php
session_start();
include_once "../../includes/datacon.php";

// Verify login and role
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_role'])) {
    header("Location: ../admin/admin_login.php");
    exit();
}

$role = $_SESSION['admin_role'];
$can_edit = in_array($role, ['trainer', 'super_admin']);

// Handle Create
if ($can_edit && isset($_POST['add_workout'])) {
    $workout_name = trim($_POST['workout_name']);
    if (!empty($workout_name)) {
        $stmt = $conn->prepare("INSERT INTO workout_plan (workout_name) VALUES (?)");
        $stmt->bind_param("s", $workout_name);
        $stmt->execute();
        $stmt->close();
        header("Location: admin_workout_plans.php");
        exit();
    }
}

// Handle Delete
if ($can_edit && isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM workout_plan WHERE table_id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: admin_workout_plans.php");
    exit();
}

// Handle Update
if ($can_edit && isset($_POST['update_workout'])) {
    $update_id = intval($_POST['table_id']);
    $updated_name = trim($_POST['workout_name']);
    if (!empty($updated_name)) {
        $stmt = $conn->prepare("UPDATE workout_plan SET workout_name = ? WHERE table_id = ?");
        $stmt->bind_param("si", $updated_name, $update_id);
        $stmt->execute();
        $stmt->close();
        header("Location: admin_workout_plans.php");
        exit();
    }
}

// Fetch all workout plans
$plans = $conn->query("SELECT * FROM workout_plan ORDER BY table_id DESC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Manage Workout Plans</title>
    <link rel="stylesheet" href="../../css/admin.css">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 10px; text-align: left; }
        form.inline-form { display: flex; gap: 10px; }
        input[type="text"] { padding: 6px; width: 300px; }
        button { padding: 6px 12px; }
    </style>
</head>
<body>
<div class="admin-container">
    <div class="content">
        <h1>Manage Workout Plans</h1>

        <!-- ADD NEW WORKOUT PLAN (only if allowed) -->
        <?php if ($can_edit): ?>
            <form method="POST" class="inline-form">
                <input type="text" name="workout_name" placeholder="Enter workout name" required />
                <button type="submit" name="add_workout">Add Workout Plan</button>
            </form>
        <?php else: ?>
            <p><em>You do not have permission to modify workout plans.</em></p>
        <?php endif; ?>

        <hr>

        <!-- LIST OF WORKOUT PLANS -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Workout Name</th>
                    <?php if ($can_edit): ?><th>Actions</th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
            <?php while ($plan = $plans->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $plan['table_id']; ?></td>
                    <td>
                        <?php if ($can_edit && isset($_GET['edit']) && $_GET['edit'] == $plan['table_id']): ?>
                            <form method="POST" class="inline-form">
                                <input type="hidden" name="table_id" value="<?php echo $plan['table_id']; ?>">
                                <input type="text" name="workout_name" value="<?php echo htmlspecialchars($plan['workout_name']); ?>" required>
                                <button type="submit" name="update_workout">Update</button>
                                <a href="admin_workout_plans.php">Cancel</a>
                            </form>
                        <?php else: ?>
                            <?php echo htmlspecialchars($plan['workout_name']); ?>
                        <?php endif; ?>
                    </td>
                    <?php if ($can_edit): ?>
                    <td>
                        <a href="admin_workout_plans.php?edit=<?php echo $plan['table_id']; ?>">Edit</a> |
                        <a href="admin_workout_plans.php?delete=<?php echo $plan['table_id']; ?>" onclick="return confirm('Are you sure you want to delete this workout plan?')">Delete</a>
                    </td>
                    <?php endif; ?>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>

        <br>
        <a href="admin_dashboard.php">← Back to Dashboard</a>
    </div>
</div>
</body>
</html>
