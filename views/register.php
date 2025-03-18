<?php
include_once "../includes/datacon.php";

// Fetch workout plans
// 
$workout_query = "SELECT table_id, workout_name FROM workout_plan";
$result = mysqli_query($conn, $workout_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EliteFit Registration</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #1e3c72, #2a5298);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Form Container */
        .form-container {
            width: 50%;
            background: rgba(255, 255, 255, 0.9);
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        h2 {
            text-align: center;
            color: #1e3c72;
            font-size: 22px;
        }

        /* Scrollable Form Section */
        .form-section {
            max-height: 350px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .hidden {
            display: none;
        }

        /* Form Inputs */
        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            color: #333;
            display: block;
            font-size: 14px;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        select {
            cursor: pointer;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #2a5298;
            box-shadow: 0px 0px 5px rgba(42, 82, 152, 0.5);
        }

        /* Buttons */
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        button {
            background: #1e3c72;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: 0.3s ease;
        }

        button:hover {
            background: #2a5298;
        }

        #prevBtn {
            background: #aaa;
        }

        #prevBtn:hover {
            background: #888;
        }
    </style>
</head>
<body>

<div class="form-container">
    <form action="../actions/register_process.php" method="POST" enctype="multipart/form-data">
        <!-- // the form action takes in the direct file for the submit logic. -->
       
        <!-- User Registration Details -->
        <div id="section1" class="form-section">
            <h2>User Registration</h2>
            <div class="form-group">
                <label>First Name:</label>
                <input type="text" name="first_name" required>
            </div>
            <div class="form-group">
                <label>Last Name:</label>
                <input type="text" name="last_name" required>
            </div>
            <div class="form-group">
                <label>Contact Number:</label>
                <input type="text" name="contact_number" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Pasword</label>
                <input type="password" name="user_password" required>
    </div>
            <div class="form-group">
                <label>Location:</label>
                <input type="text" name="location" required>
            </div>
            <div class="form-group">
                <label>Gender:</label>
                <select name="gender" required>
                    <option value="">Choose an option</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label>Date of Birth:</label>
                <input type="date" name="date_of_birth" required>
            </div>
            <div class="form-group">
                <label>Profile Picture:</label>
                <input type="file" name="profile_picture" >
            </div>
        </div>

        <!-- User Fitness Details -->
        <div id="section2" class="form-section hidden">
            <h2>Fitness Details</h2>
            <div class="form-group">
                <label>Weight (kg):</label>
                <input type="number" name="user_weight" required>
            </div>
            <div class="form-group">
                <label>Height (cm):</label>
                <input type="number" name="user_height" required>
            </div>
            <div class="form-group">
                <label>Body Type:</label>
                <input type="text" name="user_bodytype" required>
            </div>
            <div class="form-group">
                <label>Fitness Goal:</label>
                <input type="text" name="fitness_goal_1" required>
            </div>
            <div class="form-group">
                <label>Fitness Goal:</label>
                <input type="text" name="fitness_goal_2" required>
            </div>
            
            <div class="form-group">
                <!-- set the experience level range -->
                <label>Fitness Goal:</label>
                <input type="text" name="fitness_goal_3" required>
            </div>
            <div class="form-group">
                <label>Health condition:</label>
                <input type="text" name="health_condition" required>
            </div>
            <div class="form-group">
                <label>Experience Level (1-10):</label>
                <input type="number" name="experience_level" required>
            </div>
            <div class="form-group">
                <label>Preferred Workout Plan 1:</label>
                <select name="preferred_workout_plan_1" required>
                    <option value="">Choose an option</option>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <option value="<?php echo $row['table_id']; ?>"><?php echo $row['workout_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Preferred Workout Plan 2:</label>
                <select name="preferred_workout_plan_2" required>
                    <option value="">Choose an option</option>
                    <?php mysqli_data_seek($result, 0); while ($row = mysqli_fetch_assoc($result)) { ?>
                        <option value="<?php echo $row['table_id']; ?>"><?php echo $row['workout_name']; ?></option>
                    <?php } ?>

                  
                </select>
            </div>
            <div class="form-group">
                <label>Preferred Workout Plan 3:</label>
                <select name="preferred_workout_plan_3" required>
                    <option value="">Choose an option</option>
                    <?php mysqli_data_seek($result, 0); while ($row = mysqli_fetch_assoc($result)) { ?>
                        <option value="<?php echo $row['table_id']; ?>"><?php echo $row['workout_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
        
        </div>

        <div class="btn-container">
            <button type="button" id="prevBtn" class="hidden" onclick="showSection(1)">Previous</button>
            <button type="button" id="nextBtn" onclick="showSection(2)">Next</button>
            <button type="submit" id="submitBtn" class="hidden">Submit</button>
        </div>

    </form>
</div>

<script>
    function showSection(section) {
        document.getElementById("section1").classList.toggle("hidden", section !== 1);
        document.getElementById("section2").classList.toggle("hidden", section !== 2);
        document.getElementById("prevBtn").classList.toggle("hidden", section === 1);
        document.getElementById("nextBtn").classList.toggle("hidden", section === 2);
        document.getElementById("submitBtn").classList.toggle("hidden", section === 1);
    }
</script>

</body>
</html>