<?php
include_once "../includes/datacon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $_SERVER a super globabl with a bunch of arrays to check the method from the client

    function clean_input($data) {
        return is_string($data) ? htmlspecialchars(stripslashes(trim($data))) : "";
    }

    function generate_strong_password($length = 12) {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()-_=+';
        return substr(str_shuffle(str_repeat($chars, ceil($length / strlen($chars)))), 0, $length);
        // random_int() would have been more optimzed for this as opposed to str_shuffle
    }

    // User Registration Details
    $first_name = clean_input($_POST["first_name"]);
    $last_name = clean_input($_POST["last_name"]);
    $contact_number = clean_input($_POST["contact_number"]);
    $email = clean_input($_POST["email"]);
    $user_password = clean_input($_POST["user_password"]);
    $location = clean_input($_POST["location"]);
    $gender = clean_input($_POST["gender"]);
    $date_of_birth = clean_input($_POST["date_of_birth"]);
    $profile_picture = $_FILES["profile_picture"];

    // User Fitness Details
    $user_weight = clean_input($_POST["user_weight"]);
    $user_height = clean_input($_POST["user_height"]);
    $user_bodytype = clean_input($_POST["user_bodytype"]);
    $workout_1 = clean_input($_POST["preferred_workout_plan_1"]);
    $workout_2 = clean_input($_POST["preferred_workout_plan_2"]);
    $workout_3 = clean_input($_POST["preferred_workout_plan_3"]);

    // Fitness Goals and Health Details
    $fitness_goal_1 = clean_input($_POST["fitness_goal_1"]);
    $fitness_goal_2 = clean_input($_POST["fitness_goal_2"]);
    $fitness_goal_3 = clean_input($_POST["fitness_goal_3"]);
    $experience_level = clean_input($_POST["experience_level"]);
    $health_condition = clean_input($_POST["health_condition"]);
    $health_condition_desc = isset($_POST["health_condition_desc"]) ? clean_input($_POST["health_condition_desc"]) : "";

    // Validate Age
    $dob = date("Y-m-d", strtotime($date_of_birth));
    $today = date("Y-m-d");
    $age = date_diff(date_create($dob), date_create($today))->y;

    if ($age < 18 || $age > 69) {
        echo "<script>alert('You must be at least 18 and less than 70 years old to register!');  </script>";
        exit();
    }

    // Check for existing email or contact number
    $check_query = "SELECT * FROM user_register_details WHERE email='$email' OR contact_number='$contact_number'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Email or contact number already registered!');  </script>";
        exit();
    }

    if ($workout_1 == $workout_2 || $workout_1 == $workout_3 || $workout_2 == $workout_3) {
        echo "<script>alert('You cannot select the same workout routine more than once!');</script>";
        exit();
    }

    // Upload Profile Picture
    if (!empty($profile_picture["name"])) {
        $target_dir = "uploads/";
        $profile_pic_name = basename($profile_picture["name"]);
        $target_file = $target_dir . time() . "_" . $profile_pic_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (!in_array($imageFileType, ["jpg", "jpeg", "png"])) {
            echo "<script>alert('Only JPG, JPEG, and PNG files are allowed for profile pictures!');  </script>";
            exit();
        }

        if (!move_uploaded_file($profile_picture["tmp_name"], $target_file)) {
            echo "<script>alert('Error uploading profile picture!');  </script>";
            exit();
        }
    } else {
        $target_file = NULL; // No profile picture uploaded
    }
    // hash user_password
    $hashedPasswordByUser = password_hash($user_password, PASSWORD_BCRYPT);


    // Insert User Details
    $register_query = "INSERT INTO user_register_details (first_name, last_name, contact_number, email, location, gender, date_of_birth, profile_picture,user_password)
        VALUES ('$first_name', '$last_name', '$contact_number', '$email', '$location', '$gender', '$dob', '$target_file', '$hashedPasswordByUser')";

    if (!mysqli_query($conn, $register_query)) {
        echo "<script>alert('Error registering user: " . mysqli_error($conn) . "');  </script>";
        exit();
    }

    $user_id = mysqli_insert_id($conn);

    // Insert Fitness Details
    $fitness_query = "INSERT INTO user_fitness_details (table_id, user_weight, user_height, user_bodytype, preferred_workout_plan_1, preferred_workout_plan_2, preferred_workout_plan_3, fitness_goal_1, fitness_goal_2, fitness_goal_3, experience_level, health_condition, health_condition_desc)
        VALUES ('$user_id', '$user_weight', '$user_height', '$user_bodytype', '$workout_1', '$workout_2', '$workout_3', '$fitness_goal_1', '$fitness_goal_2', '$fitness_goal_3', '$experience_level', '$health_condition', '$health_condition_desc')";

    if (!mysqli_query($conn, $fitness_query)) {
        echo "<script>alert('Error saving fitness details: " . mysqli_error($conn) . "');  </script>";
        exit();
    }

    // Generate strong password
    $raw_password = generate_strong_password();
    $hashed_password = password_hash($raw_password, PASSWORD_BCRYPT);

    $login_query = "INSERT INTO user_login_details (username, user_password) VALUES ('$email', '$hashed_password')";
   
    if (!mysqli_query($conn, $login_query)) {
        echo "<script>alert('Error creating login credentials: " . mysqli_error($conn) . "');  </script>";
        exit();
    }

    echo "<script> window.location.href='../views/login.php';</script>";
}
?>
