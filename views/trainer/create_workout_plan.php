<form action="save_workout_plan.php" method="POST">
    <input type="hidden" name="member_id" value="<?= $_GET['member_id'] ?>">
    <label>Plan Title:</label>
    <input type="text" name="plan_title" required>

    <label>Description:</label>
    <textarea name="plan_description"></textarea>

    <div id="exercises">
        <h4>Exercises</h4>
        <!-- JS can clone this structure -->
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
