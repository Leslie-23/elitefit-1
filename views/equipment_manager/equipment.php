<?php
require_once '../../includes/datacon.php';

// Add New Equipment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_equipment'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $condition = $_POST['condition_status'];
    $availability = $_POST['availability_status'];
    $date_added = date('Y-m-d');
    $maintenance_date = $_POST['last_maintenance_date'];

    $stmt = $conn->prepare("INSERT INTO gym_equipment (name, description, category, condition_status, availability_status, date_added, last_maintenance_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $description, $category, $condition, $availability, $date_added, $maintenance_date);

    if ($stmt->execute()) {
        echo "Equipment added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Update Equipment Status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $equipment_id = $_POST['equipment_id'];
    $condition = $_POST['condition_status'];
    $availability = $_POST['availability_status'];

    $stmt = $conn->prepare("UPDATE gym_equipment SET condition_status = ?, availability_status = ? WHERE equipment_id = ?");
    $stmt->bind_param("ssi", $condition, $availability, $equipment_id);

    if ($stmt->execute()) {
        echo "Equipment status updated!";
    } else {
        echo "Error updating status: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch All Equipment
$result = $conn->query("SELECT * FROM gym_equipment ORDER BY equipment_id ");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Equipment Manager</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; }
        th { background-color: #f4f4f4; }
        form { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>Add Equipment</h2>
    <form method="POST">
        <input type="hidden" name="add_equipment" value="1">
        <input type="text" name="name" placeholder="Name" required><br>
        <textarea name="description" placeholder="Description" required></textarea><br>
        <input type="text" name="category" placeholder="Category" required><br>
        <select name="condition_status" required>
            <option value="Good">Good</option>
            <option value="Needs Maintenance">Needs Maintenance</option>
            <option value="Broken">Broken</option>
        </select><br>
        <select name="availability_status" required>
            <option value="Available">Available</option>
            <option value="In Use">In Use</option>
            <option value="Under Repair">Under Repair</option>
        </select><br>
        <input type="date" name="last_maintenance_date" required><br>
        <button type="submit">Add Equipment</button>
    </form>

    <h2>All Equipment</h2>
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
                <form method="POST" style="display:inline-block;">
                    <input type="hidden" name="update_status" value="1">
                    <input type="hidden" name="equipment_id" value="<?= $row['equipment_id'] ?>">
                    <select name="condition_status">
                        <option value="Good" <?= $row['condition_status'] == 'Good' ? 'selected' : '' ?>>Good</option>
                        <option value="Needs Maintenance" <?= $row['condition_status'] == 'Needs Maintenance' ? 'selected' : '' ?>>Needs Maintenance</option>
                        <option value="Broken" <?= $row['condition_status'] == 'Broken' ? 'selected' : '' ?>>Broken</option>
                    </select>
                    <select name="availability_status">
                        <option value="Available" <?= $row['availability_status'] == 'Available' ? 'selected' : '' ?>>Available</option>
                        <option value="In Use" <?= $row['availability_status'] == 'In Use' ? 'selected' : '' ?>>In Use</option>
                        <option value="Under Repair" <?= $row['availability_status'] == 'Under Repair' ? 'selected' : '' ?>>Under Repair</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
