<?php
include '../../includes/datacon.php'; // include DB connection

// Fetch all members
$members = $conn->query("SELECT table_id, first_name, last_name FROM user_register_details");

// If a member is selected
$selected_member = isset($_GET['table_id']) ? $_GET['table_id'] : null;
$fitness_data = null;

if ($selected_member) {
    $stmt = $conn->prepare("SELECT * FROM user_fitness_details WHERE table_id = ?");
    $stmt->bind_param("i", $selected_member);
    $stmt->execute();
    $fitness_data = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
?>


<form method="GET" action="">
    <label for="member_select">Select Member:</label>
    <select name="table_id" id="member_select" onchange="this.form.submit()">
        <option value="">-- Choose Member --</option>
        <?php while ($member = $members->fetch_assoc()): ?>
            <option value="<?= $member['table_id'] ?>" <?= $selected_member == $member['table_id'] ? 'selected' : '' ?>>
                <?= $member['first_name'] . ' ' . $member['last_name'] ?>
            </option>
        <?php endwhile; ?>
    </select>
</form>

<?php if ($selected_member && $fitness_data): ?>
<form action="save_workout_plan.php" method="POST">
    <input type="hidden" name="member_id" value="<?= $selected_member ?>">

    <h3>Fitness Details for Member ID <?= $selected_member ?></h3>
    <!-- Display and Edit Fitness Info -->
    <!-- 
    <label>Height (cm):</label>
    <input type="number" name="height" value="<?= $fitness_data['height'] ?>" required>

    <label>Weight (kg):</label>
    <input type="number" name="weight" value="<?= $fitness_data['weight'] ?>" required>

    <label>BMI:</label>
    <input type="text" name="bmi" value="<?= $fitness_data['bmi'] ?>" readonly>

    <label>Fitness Goals:</label>
    <textarea name="fitness_goals"><?= htmlspecialchars($fitness_data['fitness_goals']) ?></textarea> -->

    <hr>

    <!-- Workout Plan Section -->
    <label>Plan Title:</label>
    <input type="text" name="plan_title" required>

    <label>Description:</label>
    <textarea name="plan_description"></textarea>

    <div id="exercises">
        <h4>Exercises</h4>
        <div class="exercise">
            <input type="text" name="exercise_name[]" placeholder="Exercise Name" required>
            <input type="number" name="sets[]" placeholder="Sets">
            <input type="number" name="reps[]" placeholder="Reps">
            <input type="text" name="duration[]" placeholder="Duration">
            <select name="intensity_level[]">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>
    </div>

    <button type="submit">Submit Plan</button>
</form>
<?php elseif ($selected_member): ?>
    <p>No fitness data found for this member.</p>
<?php endif; ?>
