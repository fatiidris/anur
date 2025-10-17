<?php
// Replace with your email address
$to_email = "fatiidris2012@gmail.com";

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Email headers
$headers = "From: " . $name . " <" . $email . ">\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";

// Email content
$email_body = "<h2>New Message from Contact Form</h2>";
$email_body .= "<p><strong>Name:</strong> " . $name . "</p>";
$email_body .= "<p><strong>Email:</strong> " . $email . "</p>";
$email_body .= "<p><strong>Subject:</strong> " . $subject . "</p>";
$email_body .= "<p><strong>Message:</strong><br>" . $message . "</p>";

// Send the email
if (mail($to_email, $subject, $email_body, $headers)) {
    // Redirect to a success page
    header("Location: contact-success.html");
} else {
    // Redirect to an error page
    header("Location: contact-error.html");
}
?>