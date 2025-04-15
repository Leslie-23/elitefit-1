<?php
session_start();
require_once '../../includes/datacon.php';

// Ensure user is logged in
if (!isset($_SESSION['admin_id'])) {
    die("Access Denied. Please <a href='../admin/admin_login.php'>login</a>.");
}

// Check role from admin table
$admin_id = $_SESSION['admin_id'];
$stmt = $conn->prepare("SELECT admin_role FROM admin_users WHERE admin_id = ?");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user || $user['admin_role'] !== 'equipment_manager') {
    die("Unauthorized access. You do not have permission to manage equipment.");
}

// Handle Add Equipment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_equipment'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $condition = $_POST['condition_status'];
    $availability = $_POST['availability_status'];
    $maintenance_date = $_POST['last_maintenance_date'];
    $date_added = date('Y-m-d');

    $stmt = $conn->prepare("INSERT INTO gym_equipment (name, description, category, condition_status, availability_status, date_added, last_maintenance_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $description, $category, $condition, $availability, $date_added, $maintenance_date);

    if ($stmt->execute()) {
        $message = "✅ Equipment added successfully.";
    } else {
        $message = "❌ Error: " . $stmt->error;
    }
    $stmt->close();
}

// Handle Update Status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $equipment_id = $_POST['equipment_id'];
    $condition = $_POST['condition_status'];
    $availability = $_POST['availability_status'];

    $stmt = $conn->prepare("UPDATE gym_equipment SET condition_status = ?, availability_status = ? WHERE equipment_id = ?");
    $stmt->bind_param("ssi", $condition, $availability, $equipment_id);

    if ($stmt->execute()) {
        $message = "✅ Equipment status updated.";
    } else {
        $message = "❌ Error updating: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch Equipment Records
$result = $conn->query("SELECT * FROM gym_equipment ORDER BY date_added ASC");



?>

<!DOCTYPE html>
<html>
<head>
    <title>Equipment Manager Dashboard</title>
    <!-- <style>
        body { font-family: Arial; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f4f4f4; }
        input, select, textarea, button { margin: 5px 0; padding: 8px; width: 100%; }
        form { margin-bottom: 20px; }
        .success { color: green; }
        .error { color: red; }
    </style> -->
    <link rel="stylesheet" href="../../css/equipment.css">
</head>
<body>
    
    <h2>Equipment Manager Dashboard</h2>
    <div class="tab-nav">
        <a href="#add_equipment" class="tab-link">➕ Add Equipment</a>
        <a href="#manage_equipment" class="tab-link">🛠 Manage Equipment</a>
    </div>
    <?php if (isset($message)): ?>
        <p class="<?= strpos($message, '✅') !== false ? 'success' : 'error' ?>"><?= $message ?></p>
    <?php endif; ?>
    <div id="add_equipment" class="tab-section">
    <h3>Add New Equipment</h3>
    <form method="POST">
        <input type="hidden" name="add_equipment" value="1">
        <input type="text" name="name" placeholder="Equipment Name" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="text" name="category" placeholder="Category" required>
        <select name="condition_status" required>
            <option value="good">Good</option>
            <option value="maintenance">Needs Maintenance</option>
            <option value="damaged">Broken</option>
        </select>
        <select name="availability_status" required>
            <option value="available">Available</option>
            <option value="in_use">In Use</option>
            <option value="out_of_order">Under Repair</option>
        </select>
        <label>Last Maintenance Date</label>
        <input type="date" name="last_maintenance_date" required>
        <button type="submit">Add Equipment</button>
    </form>
    </div>
    <div id="manage_equipment" class="tab-section">
    <h3>Equipment List</h3>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Category</th><th>Status</th><th>Availability</th><th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['equipment_id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['category']) ?></td>
            <td><?= htmlspecialchars($row['condition_status']) ?></td>
            <td><?= htmlspecialchars($row['availability_status']) ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="update_status" value="1">
                    <input type="hidden" name="equipment_id" value="<?= $row['equipment_id'] ?>">
                    <select name="condition_status">
                        <option value="good" <?= $row['condition_status'] === 'Good' ? 'selected' : '' ?>>Good</option>
                        <option value="maintenance" <?= $row['condition_status'] === 'Needs Maintenance' ? 'selected' : '' ?>>Needs Maintenance</option>
                        <option value="damaged" <?= $row['condition_status'] === 'Broken' ? 'selected' : '' ?>>Broken</option>
                    </select>
                    <select name="availability_status">
                        <option value="available" <?= $row['availability_status'] === 'Available' ? 'selected' : '' ?>>Available</option>
                        <option value="in_use" <?= $row['availability_status'] === 'In Use' ? 'selected' : '' ?>>In Use</option>
                        <option value="out_of_order" <?= $row['availability_status'] === 'Under Repair' ? 'selected' : '' ?>>Under Repair</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
        </div>

</body>

<script>
    window.onload = function () {
        if (!window.location.hash) {
            window.location.hash = "#add_equipment";
        }
    };
</script>
</html>
