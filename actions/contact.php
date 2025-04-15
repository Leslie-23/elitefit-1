<?php
// contact.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and collect data
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone   = htmlspecialchars(trim($_POST['phone']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate required fields
    if (empty($name) || empty($email) || empty($message)) {
        echo "Please fill in all required fields.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Recipient Email (Set to your real email)
    $to = "seunpaul003@example.com";

    // Email Subject
    $email_subject = "Contact Form Submission: $subject";

    // Email Body
    $email_body = "
    You have received a new message from EliteFit contact form.

    Full Name: $name
    Email: $email
    Phone: $phone
    Subject: $subject

    Message:
    $message
    ";

    // Email Headers
    $headers = "From: EliteFit Contact Form <no-reply@elitefit.com>\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send Email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "Something went wrong. Please try again later.";
    }
} else {
    echo "Invalid request.";
}
?>
