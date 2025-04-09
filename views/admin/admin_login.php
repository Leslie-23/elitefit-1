<?php
session_start();
// Redirect if already logged in
if (isset($_SESSION['admin_id'])) {
    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="EliteFit - Admin Login">
    <title>EliteFit - Admin Portal</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: var(--color-light-gray);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            font-family: 'Roboto', sans-serif;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background-color: var(--color-white);
            border: 2px solid var(--color-black);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }

        .login-header {
            background-color: var(--color-black);
            color: var(--color-white);
            padding: 20px;
            text-align: center;
        }

        .login-header h1 {
            margin: 0;
            font-size: 1.8rem;
            color: var(--color-white);
            font-family: 'Poppins', sans-serif;
        }

        .login-header p {
            margin-top: 5px;
            font-size: 1rem;
            opacity: 0.8;
        }

        .login-form {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--color-black);
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid var(--color-light-gray);
            background-color: var(--color-white);
            transition: var(--transition);
            font-family: 'Roboto', sans-serif;
        }

        .form-group input:focus {
            border-color: var(--color-black);
            outline: none;
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

        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: var(--color-black);
            color: var(--color-white);
            border: 2px solid var(--color-black);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: var(--transition);
            font-family: 'Poppins', sans-serif;
        }

        .login-btn:hover {
            background-color: var(--color-white);
            color: var(--color-black);
        }

        .error-message {
            color: #d9534f;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            display: none;
        }
        
        .error-message.show {
            display: block;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-header">
        <h1>EliteFit Admin</h1>
        <p>Access the administration portal</p>
    </div>

    <div class="login-form">
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message show">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="../../actions/admin_actions/admin_process.php" method="POST">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-input">
                    <input type="password" id="password" name="admin_password" required>
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="login-btn">Login</button>
            <p>Don't have an account? <a href="admin_register.php">Sign up</a></p>
        </form>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
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
</script>

</body>
</html>