<?php
include_once "../includes/datacon.php";

// Fetch workout plans
$workout_query = "SELECT table_id, workout_name FROM workout_plan";
$result = mysqli_query($conn, $workout_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Join EliteFit - Register for premium fitness services and personalized training programs.">
    <title>EliteFit - Registration</title>
    <link rel="stylesheet" href="../css/index.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Registration Form Specific Styles */
        body {
            background-color: var(--color-light-gray);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            font-family: 'Roboto', sans-serif;
        }

        .registration-container {
            width: 100%;
            max-width: 800px;
            background-color: var(--color-white);
            border: 2px solid var(--color-black);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }

        .registration-header {
            background-color: var(--color-black);
            color: var(--color-white);
            padding: 20px;
            text-align: center;
        }

        .registration-header h1 {
            margin: 0;
            font-size: 1.8rem;
            color: var(--color-white);
            font-family: 'Poppins', sans-serif;
        }

        .registration-header p {
            margin-top: 5px;
            font-size: 1rem;
            opacity: 0.8;
        }

        .registration-progress {
            display: flex;
            margin: 0;
            padding: 0;
            background-color: var(--color-light-gray);
        }

        .progress-step {
            flex: 1;
            padding: 15px 0;
            text-align: center;
            font-weight: 500;
            color: var(--color-medium-gray);
            position: relative;
            cursor: pointer;
            transition: var(--transition);
        }

        .progress-step.active {
            background-color: var(--color-black);
            color: var(--color-white);
        }

        .form-section {
            padding: 30px;
            max-height: 500px;
            overflow-y: auto;
        }

        .form-section h2 {
            margin-top: 0;
            margin-bottom: 25px;
            font-size: 1.5rem;
            position: relative;
            padding-bottom: 10px;
            font-family: 'Poppins', sans-serif;
        }

        .form-section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--color-black);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--color-black);
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid var(--color-light-gray);
            background-color: var(--color-white);
            transition: var(--transition);
            font-family: 'Roboto', sans-serif;
            border: 0.5px gray solid;
            border-radius: 0px;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--color-black);
            outline: none;
        }

        .form-group input[type="file"] {
            padding: 8px;
            border: 2px dashed var(--color-light-gray);
            background-color: var(--color-white);
            cursor: pointer;
        }

        .form-group input[type="file"]:hover {
            border-color: var(--color-medium-gray);
        }

        .password-input {
            position: relative;
        }

        .password-input input {
            width: 100%;
            padding: 12px;
            padding-right: 40px;
            border: 2px solid var(--color-light-gray);
            background-color: var(--color-white);
            transition: var(--transition);
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--color-medium-gray);
            cursor: pointer;
        }

        .password-toggle:hover {
            color: var(--color-black);
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            padding: 20px 30px;
            background-color: var(--color-light-gray);
            border-top: 1px solid var(--color-light-gray);
        }

        .btn {
            padding: 12px 24px;
            border: 2px solid var(--color-black);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: var(--transition);
            font-family: 'Poppins', sans-serif;
        }

        .btn-prev {
            background-color: var(--color-white);
            color: var(--color-black);
        }

        .btn-prev:hover {
            background-color: var(--color-medium-gray);
            color: var(--color-white);
            border-color: var(--color-medium-gray);
        }

        .btn-next,
        .btn-submit {
            background-color: var(--color-black);
            color: var(--color-white);
        }

        .btn-next:hover,
        .btn-submit:hover {
            background-color: var(--color-white);
            color: var(--color-black);
        }

        .hidden {
            display: none;
        }

        .back-to-home {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: var(--color-black);
            font-weight: 500;
            text-decoration: underline;
        }

        .back-to-home:hover {
            color: var(--color-medium-gray);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full-width {
                grid-column: span 1;
            }
        }
    </style>
</head>
<body>

<div class="registration-container">
    <div class="registration-header">
        <h1>Join EliteFit</h1>
        <p>Transform your fitness journey with us</p>
    </div>

    <div class="registration-progress">
        <div class="progress-step active" id="step1" onclick="showSection(1)">Personal Details</div>
        <div class="progress-step" id="step2" onclick="showSection(2)">Fitness Profile</div>
        <div class="progress-step" id="step3" onclick="showSection(3)">Set Password</div>
    </div>

    <form action="../actions/register_process.php" method="POST" enctype="multipart/form-data">
        <!-- User Registration Details -->
        <div id="section1" class="form-section">
            <h2>Personal Information</h2>
            <div class="form-grid">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="contact_number">Contact Number</label>
                    <input type="text" id="contact_number" name="contact_number" required>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="">Select gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <!-- <option value="Other">Other</option> -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" required>
                </div>
                <div class="form-group">
                    <label for="profile_picture">Profile Picture</label>
                    <input type="file" id="profile_picture" name="profile_picture">
                </div>
            </div>
        </div>

        <!-- User Fitness Details -->
        <div id="section2" class="form-section hidden">
            <h2>Fitness Profile</h2>
            <div class="form-grid">
                <div class="form-group">
                    <label for="user_weight">Weight (kg)</label>
                    <input type="number" id="user_weight" name="user_weight" required>
                </div>
                <div class="form-group">
                    <label for="user_height">Height (cm)</label>
                    <input type="number" id="user_height" name="user_height" required>
                </div>
                <div class="form-group">
                    <label for="user_bodytype">Body Type</label>
                    <select id="user_bodytype" name="user_bodytype" required>
                        <option value="">Select body type</option>
                        <option value="Ectomorph">Ectomorph</option>
                        <option value="Mesomorph">Mesomorph</option>
                        <option value="Endomorph">Endomorph</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="experience_level">Experience Level (1-10)</label>
                    <input type="range" id="experience_level" name="experience_level" min="1" max="10" value="5" 
                           oninput="this.nextElementSibling.value = this.value">
                    <output>5</output>
                </div>
                <div class="form-group">
                    <label for="fitness_goal_1">Primary Fitness Goal</label>
                    <input type="text" id="fitness_goal_1" name="fitness_goal_1" required>
                </div>
                <div class="form-group">
                    <label for="fitness_goal_2">Secondary Fitness Goal</label>
                    <input type="text" id="fitness_goal_2" name="fitness_goal_2" required>
                </div>
                <div class="form-group">
                    <label for="fitness_goal_3">Additional Fitness Goal</label>
                    <input type="text" id="fitness_goal_3" name="fitness_goal_3" required>
                </div>
                <div class="form-group">
                    <label for="health_condition">Health Conditions</label>
                    <input type="text" id="health_condition" name="health_condition" placeholder="Any medical conditions we should know about" required>
                </div>
                <div class="form-group">
                    <label for="preferred_workout_plan_1">Preferred Workout Plan 1</label>
                    <select id="preferred_workout_plan_1" name="preferred_workout_plan_1" required>
                        <option value="">Select workout plan</option>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?php echo $row['table_id']; ?>"><?php echo $row['workout_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="preferred_workout_plan_2">Preferred Workout Plan 2</label>
                    <select id="preferred_workout_plan_2" name="preferred_workout_plan_2" required>
                        <option value="">Select workout plan</option>
                        <?php mysqli_data_seek($result, 0); while ($row = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?php echo $row['table_id']; ?>"><?php echo $row['workout_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="preferred_workout_plan_3">Preferred Workout Plan 3</label>
                    <select id="preferred_workout_plan_3" name="preferred_workout_plan_3" required>
                        <option value="">Select workout plan</option>
                        <?php mysqli_data_seek($result, 0); while ($row = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?php echo $row['table_id']; ?>"><?php echo $row['workout_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Password Section -->
        <div id="section3" class="form-section hidden">
            <h2>Set Your Password</h2>
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="user_password">Create Password</label>
                    <div class="password-input">
                        <input type="password" id="user_password" name="user_password" required minlength="8">
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <p class="password-hint">Password must be at least 8 characters long</p>
                </div>
                <div class="form-group full-width">
                    <label for="confirm_password">Confirm Password</label>
                    <div class="password-input">
                        <input type="password" id="confirm_password" name="confirm_password" required>
                        <button type="button" class="password-toggle" onclick="toggleConfirmPassword()">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <p id="password-match-message"></p>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="button" id="prevBtn" class="btn btn-prev hidden" onclick="prevSection()">Previous</button>
            <button type="button" id="nextBtn" class="btn btn-next" onclick="nextSection()">Next</button>
            <button type="submit" id="submitBtn" class="btn btn-submit hidden">Complete Registration</button>
        </div>
    </form>
</div>

<script>
    // Track current section
    let currentSection = 1;
    
    function showSection(section) {
        // Update form sections visibility
        document.getElementById("section1").classList.toggle("hidden", section !== 1);
        document.getElementById("section2").classList.toggle("hidden", section !== 2);
        document.getElementById("section3").classList.toggle("hidden", section !== 3);
        
        // Update buttons visibility
        document.getElementById("prevBtn").classList.toggle("hidden", section === 1);
        document.getElementById("nextBtn").classList.toggle("hidden", section === 3);
        document.getElementById("submitBtn").classList.toggle("hidden", section !== 3);
        
        // Update progress steps
        document.getElementById("step1").classList.toggle("active", section === 1);
        document.getElementById("step2").classList.toggle("active", section === 2);
        document.getElementById("step3").classList.toggle("active", section === 3);
        
        // Update current section tracker
        currentSection = section;
    }
    
    function nextSection() {
        if (currentSection < 3) {
            showSection(currentSection + 1);
        }
    }
    
    function prevSection() {
        if (currentSection > 1) {
            showSection(currentSection - 1);
        }
    }
    
    // Password visibility toggle
    function togglePassword() {
        const passwordInput = document.getElementById('user_password');
        const icon = document.querySelector('.password-toggle i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    
    function toggleConfirmPassword() {
        const confirmInput = document.getElementById('confirm_password');
        const icon = document.querySelectorAll('.password-toggle i')[1];
        
        if (confirmInput.type === 'password') {
            confirmInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            confirmInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    
    // Check password match
    const confirmInput = document.getElementById('confirm_password');
    const passwordInput = document.getElementById('user_password');
    const matchMessage = document.getElementById('password-match-message');
    
    confirmInput.addEventListener('input', checkPasswordMatch);
    passwordInput.addEventListener('input', function() {
        if (confirmInput.value) {
            checkPasswordMatch();
        }
    });
    
    function checkPasswordMatch() {
        if (passwordInput.value === confirmInput.value) {
            matchMessage.textContent = "Passwords match";
            matchMessage.style.color = "green";
        } else {
            matchMessage.textContent = "Passwords do not match";
            matchMessage.style.color = "red";
        }
    }
    
    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const password = document.getElementById('user_password');
        const confirmPassword = document.getElementById('confirm_password');
        
        if (password.value.length < 8) {
            e.preventDefault();
            alert('Password must be at least 8 characters long');
            password.focus();
            return;
        }
        
        if (password.value !== confirmPassword.value) {
            e.preventDefault();
            alert('Passwords do not match');
            confirmPassword.focus();
            return;
        }
    });
</script>

</body>
</html>