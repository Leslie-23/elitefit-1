<?php
session_start();
include_once "../../includes/datacon.php";

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
// exit(); //debug line to test and see whats in the session

// Get admin information
$admin_name = $_SESSION['admin_name'];
$email = $_SESSION['admin_email'];
$admin_role = $_SESSION['admin_role'];

// Get statistics
$totalUsers = $conn->query("SELECT COUNT(*) as count FROM user_register_details")->fetch_assoc()['count'];
$totalWorkoutPlans = $conn->query("SELECT COUNT(*) as count FROM workout_plan")->fetch_assoc()['count'];
$totalEquipment = $conn->query("SELECT COUNT(*) as count FROM gym_equipment")->fetch_assoc()['count'];

// Get recent users
$recentUsers = $conn->query("SELECT first_name, last_name, email, date_of_registration FROM user_register_details ORDER BY date_of_registration DESC LIMIT 5");

$today = date('Y-m-d');
$stmt = $conn->prepare("SELECT COUNT(*) AS active_count FROM trainer_sessions WHERE session_date = ? ");
$stmt->bind_param("s", $today);
$stmt->execute();
$result = $stmt->get_result();
$activeSessionsToday = $result->fetch_assoc()['active_count'];
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="EliteFit - Admin Dashboard">
    <title>EliteFit - Admin Dashboard</title>
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
</head>
<body>
<!-- Sidebar toggle button for mobile -->
<button class="sidebar-toggle" id="sidebarToggle">
    <i class="fas fa-bars"></i>
</button>
<div class="admin-container">
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>EliteFit Admin</h2>
            <p>Dashboard Portal</p>
        </div>
        <div class="sidebar-menu">
            <a href="admin_dashboard.php" class="menu-item active">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="admin_users.php" class="menu-item">
                <i class="fas fa-users"></i> Manage Users
            </a>
            <a href="../trainer/workout_plans.php" class="menu-item">
                <i class="fas fa-dumbbell"></i> Workout Plans
            </a>
            <a href="../equipment_manager/equipment.php" class="menu-item">
                <i class="fas fa-toolbox"></i> Equipment
            </a>
            <a href="../trainer/trainer_dashboard.php" class="menu-item">
                <i class="fas fa-user-tie"></i> Trainers
            </a>
            <a href="admin_settings.php" class="menu-item">
                <i class="fas fa-cog"></i> Settings
            </a>
        </div>
    </div>

    <div class="content">
        <div class="dashboard-header">
            <div class="dashboard-title">
                <h1>Admin Dashboard</h1>
            </div>
            <div class="admin-info">
                <div class="admin-name">
                    <strong><?php echo htmlspecialchars($admin_name ?? '$admin_name'); ?></strong>
                    <strong style="font-style: italic"><?php echo  htmlspecialchars($email ?? 'admin_email'); ?></strong>
                    <span><?php echo htmlspecialchars($admin_role ?? 'admin_role'); ?></span>
                </div>
                <form action="./admin_logout.php" method="POST">
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="stat-cards">
            <div class="stat-card">
                <h3>Total Users</h3>
                <div class="stat-value"><?php echo $totalUsers; ?></div>
                <div class="stat-label">Registered members</div>
            </div>
            <div class="stat-card">
                <h3>Workout Plans</h3>
                <div class="stat-value"><?php echo $totalWorkoutPlans; ?></div>
                <div class="stat-label">Available plans</div>
            </div>
            <div class="stat-card">
                <h3>Active Sessions</h3>
                <div class="stat-value"><?php echo $activeSessionsToday; ?></div>
                <div class="stat-label">Today</div>
            </div>
            <div class="stat-card">
                <h3>Equipment</h3>
                <div class="stat-value"><?php echo $totalEquipment; ?></div>
                <div class="stat-label">Total items</div>
            </div>
        </div>

        <div class="recent-section recent-users">
            <h2>Recent Registrations</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registration Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = $recentUsers->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo date('M d, Y', strtotime($user['date_of_registration'])); ?></td>
                        <!-- <td>
                            <a href="admin_user_details.php?id=<?php echo $user['id']; ?>" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td> --> <td>Actions(NFY)</td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <a href="./users/users.php" class="view-all">View all users <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</div>



<script>
    const toggleBtn = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    const content = document.querySelector('.content');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        content.classList.toggle('shift');
    });
</script>

</body>
</html>


