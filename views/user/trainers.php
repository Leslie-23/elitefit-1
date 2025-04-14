<?php
include_once "../../includes/session.php";
include_once "../../includes/datacon.php";

// Fetch all trainers from the database
$query = "SELECT trainer_id, full_name, specialization, email, phone_number FROM trainers ORDER BY full_name";
$result = $conn->query($query);

$trainers = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $trainers[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Trainers</title>
    <link rel="stylesheet" href="../../css/dashboard.css">
    <style>
       .content {
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 1.6rem;
    color: #333;
}

.trainer-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 15px;
    max-height: 90vh;
    overflow-y: auto;
    padding: 5px;
}

.trainer-card {
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 12px;
    padding: 12px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.trainer-card img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 10px;
    border: 2px solid #f0f0f0;
}

.trainer-info h3 {
    font-size: 1rem;
    margin: 5px 0;
    color: #2c3e50;
}

.trainer-info p {
    font-size: 0.85rem;
    margin: 3px 0;
    color: #555;
}
    </style>
</head>
<body>
<div class="content">
    <h2>Available Trainers</h2>

    <?php if (empty($trainers)): ?>
        <p>No trainers found at the moment.</p>
    <?php else: ?>
        <div class="trainer-grid">
        <?php foreach ($trainers as $trainer): ?>
            <div class="trainer-card">
                <!-- <img src="<?= htmlspecialchars($trainer['profile_picture'] ?? '../../assets/default-avatar.png') ?>" alt="Trainer Photo"> -->
                <img href="https://placehold.co/70x70" src="https://placehold.co/70x70" alt="Trainer Photo">
                <div class="trainer-info">
                    <h3><?= htmlspecialchars($trainer['full_name']) ?></h3>
                    <p><strong>Specialization:</strong> <?= htmlspecialchars($trainer['specialization']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($trainer['email']) ?></p>
                    <p><strong>Phone:</strong> <?= htmlspecialchars($trainer['phone_number']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
