<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Email details
    $to = "youremail@example.com";  // Replace with your actual email address
    $email_subject = "Contact Form Submission: $subject";
    $email_body = "You have received a new message from your website contact form.\n\n".
                  "Here are the details:\n\n".
                  "Name: $name\n".
                  "Email: $email\n".
                  "Subject: $subject\n".
                  "Message:\n$message";

    // Headers
    $headers = "From: no-reply@yourdomain.com\r\n"; // Replace with your domain email
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send email
    if (mail($to, $email_subject, $email_body, $headers)) {
        // Success message output
        echo "Your message has been sent. Thank you!";
    } else {
        // Failure message output
        echo "There was a problem sending your message.";
    }
} else {
    echo "Invalid request method.";
}
?>
