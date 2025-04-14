<?php
include_once "../includes/session.php";
include_once "../includes/datacon.php";

$first_name = $_SESSION['first_name'];
$table_id = $_SESSION['user_id'];

// Fetch user fitness details
$stmt = $conn->prepare("
    SELECT u.user_weight, u.user_height, u.user_bodytype, 
           u.preferred_workout_plan_1, u.preferred_workout_plan_2, u.preferred_workout_plan_3, 
           u.fitness_goal_1, u.fitness_goal_2, u.fitness_goal_3, 
           u.health_condition, u.experience_level, w1.workout_name AS plan1, 
           w2.workout_name AS plan2, w3.workout_name AS plan3
    FROM user_fitness_details u
    LEFT JOIN workout_plan w1 ON u.preferred_workout_plan_1 = w1.table_id
    LEFT JOIN workout_plan w2 ON u.preferred_workout_plan_2 = w2.table_id
    LEFT JOIN workout_plan w3 ON u.preferred_workout_plan_3 = w3.table_id
    WHERE u.table_id = ?
");
$stmt->bind_param("i", $table_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();
$stmt->close();
$conn->close();

// Calculate BMI
$weight = $user_data['user_weight'];
$height = $user_data['user_height'] / 100; // Convert cm to meters
$bmi = round($weight / ($height * $height), 1);

// Determine BMI category
$bmi_category = '';
if ($bmi < 18.5) {
    $bmi_category = 'Underweight';
} elseif ($bmi >= 18.5 && $bmi < 25) {
    $bmi_category = 'Normal weight';
} elseif ($bmi >= 25 && $bmi < 30) {
    $bmi_category = 'Overweight';
} else {
    $bmi_category = 'Obese';
}

// Calculate experience level percentage
$experience_percentage = ($user_data['experience_level'] / 10) * 100;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EliteFit Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Mobile Toggle Button -->
    <div class="mobile-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h2>EliteFit</h2>
            <button class="toggle-btn" onclick="toggleSidebar()">
                <i class="fas fa-chevron-left" id="toggle-icon"></i>
            </button>
        </div>
        <ul class="nav-links">
            <li>
                <a href="#" class="active">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="./user/workout.php">
                    <i class="fas fa-dumbbell"></i>
                    <span>My Workouts</span>
                </a>
            </li>
            <li>
                <a href="./user/trainers.php">
                    <i class="fas fa-user-friends"></i>
                    <span>Trainers</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-chart-line"></i>
                    <span>Progress</span>
                </a>
            </li>
            <li>
                <a href="./user/schedule.php">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Schedule</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li>
            <li>
                <a href="./logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="dashboard-header">
            <h2>Welcome, <?= htmlspecialchars($first_name, ENT_QUOTES, 'UTF-8') ?>!</h2>
            <div class="date"><?= date("F j, Y") ?></div>
        </div>
        
        <div class="dashboard-grid">
            <!-- Fitness Stats Card -->
            <div class="card fitness-stats">
                <div class="card-header">
                    <h3><i class="fas fa-heartbeat"></i> Fitness Stats</h3>
                </div>
                <div class="card-body">
                    <p>
                        <strong>Weight:</strong>
                        <span class="stat-value"><?= htmlspecialchars($user_data['user_weight']) ?> kg</span>
                    </p>
                    <p>
                        <strong>Height:</strong>
                        <span class="stat-value"><?= htmlspecialchars($user_data['user_height']) ?> cm</span>
                    </p>
                    <p>
                        <strong>Body Type:</strong>
                        <span class="stat-value"><?= htmlspecialchars($user_data['user_bodytype']) ?></span>
                    </p>
                    <p>
                        <strong>BMI:</strong>
                        <span class="stat-value"><?= $bmi ?> (<?= $bmi_category ?>)</span>
                    </p>
                </div>
            </div>
            
            <!-- Workout Plans Card -->
            <div class="card workout-plans">
                <div class="card-header">
                    <h3><i class="fas fa-dumbbell"></i> Workout Plans</h3>
                </div>
                <div class="card-body">
                    <div class="plan">
                        <div class="plan-icon">
                            <i class="fas fa-running"></i>
                        </div>
                        <div class="plan-details">
                            <div class="plan-name"><?= htmlspecialchars($user_data['plan1']) ?></div>
                            <div class="plan-type">Primary Plan</div>
                        </div>
                    </div>
                    <div class="plan">
                        <div class="plan-icon">
                            <i class="fas fa-biking"></i>
                        </div>
                        <div class="plan-details">
                            <div class="plan-name"><?= htmlspecialchars($user_data['plan2']) ?></div>
                            <div class="plan-type">Secondary Plan</div>
                        </div>
                    </div>
                    <div class="plan">
                        <div class="plan-icon">
                            <i class="fas fa-swimmer"></i>
                        </div>
                        <div class="plan-details">
                            <div class="plan-name"><?= htmlspecialchars($user_data['plan3']) ?></div>
                            <div class="plan-type">Tertiary Plan</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Fitness Goals Card -->
            <div class="card goals-card">
                <div class="card-header">
                    <h3><i class="fas fa-bullseye"></i> Fitness Goals</h3>
                </div>
                <div class="card-body">
                    <div class="goal">
                        <div class="goal-marker"></div>
                        <div class="goal-text"><?= htmlspecialchars($user_data['fitness_goal_1']) ?></div>
                    </div>
                    <div class="goal">
                        <div class="goal-marker"></div>
                        <div class="goal-text"><?= htmlspecialchars($user_data['fitness_goal_2']) ?></div>
                    </div>
                    <div class="goal">
                        <div class="goal-marker"></div>
                        <div class="goal-text"><?= htmlspecialchars($user_data['fitness_goal_3']) ?></div>
                    </div>
                </div>
            </div>
            
            <!-- Experience Level Card -->
            <div class="card experience-card">
                <div class="card-header">
                    <h3><i class="fas fa-star"></i> Experience Level</h3>
                </div>
                <div class="card-body">
                    <p>Your current fitness experience level</p>
                    <div class="level-bar">
                        <div class="level-progress" style="width: <?= $experience_percentage ?>%"></div>
                    </div>
                    <div class="level-text">
                        <span>Beginner</span>
                        <span><?= htmlspecialchars($user_data['experience_level']) ?>/10</span>
                        <span>Expert</span>
                    </div>
                </div>
            </div>
            
            <!-- Health Condition Card -->
            <div class="card health-card">
                <div class="card-header">
                    <h3><i class="fas fa-notes-medical"></i> Health Condition</h3>
                </div>
                <div class="card-body">
                    <p>Important health information for your trainers</p>
                    <div class="condition">
                        <?= htmlspecialchars($user_data['health_condition']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle sidebar function
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const toggleIcon = document.getElementById('toggle-icon');
            
            sidebar.classList.toggle('expanded');
            
            // Update toggle icon
            if (sidebar.classList.contains('expanded')) {
                toggleIcon.classList.remove('fa-chevron-right');
                toggleIcon.classList.add('fa-chevron-left');
            } else {
                toggleIcon.classList.remove('fa-chevron-left');
                toggleIcon.classList.add('fa-chevron-right');
            }
        }
        
        // Check screen size on load and resize
        function checkScreenSize() {
            const sidebar = document.getElementById('sidebar');
            const toggleIcon = document.getElementById('toggle-icon');
            
            if (window.innerWidth <= 992) {
                sidebar.classList.remove('expanded');
                toggleIcon.classList.remove('fa-chevron-left');
                toggleIcon.classList.add('fa-chevron-right');
            } else {
                sidebar.classList.add('expanded');
                toggleIcon.classList.remove('fa-chevron-right');
                toggleIcon.classList.add('fa-chevron-left');
            }
        }
        
        // Run on page load
        window.addEventListener('load', checkScreenSize);
        
        // Run when window is resized
        window.addEventListener('resize', checkScreenSize);
    </script>
</body>
</html>