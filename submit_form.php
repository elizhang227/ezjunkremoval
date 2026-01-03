<?php
// CONFIG — Enter your email address here
$recipient_email = "your@youremail.com";
$subject = "New EZ Junk Removal Lead";

// Get POST data & sanitize
$name    = strip_tags(trim($_POST["name"] ?? ""));
$phone   = strip_tags(trim($_POST["phone"] ?? ""));
$email   = strip_tags(trim($_POST["email"] ?? ""));
$service = strip_tags(trim($_POST["service"] ?? ""));
$message = strip_tags(trim($_POST["message"] ?? ""));

// Validation
if ( empty($name) || empty($phone) || empty($service) ) {
    http_response_code(400);
    echo "Please fill in all required fields.";
    exit;
}

// Build Email
$email_body  = "You have a new lead from your website!\n\n";
$email_body .= "Name: $name\n";
$email_body .= "Phone: $phone\n";
$email_body .= "Email: $email\n";
$email_body .= "Service Needed: $service\n";
$email_body .= "Message: $message\n";

// Additional headers
$headers = "From: EZ Junk Removal Lead <noreply@". $_SERVER['SERVER_NAME'] .">\r\n";
$headers .= "Reply-To: $email";

// Try sending email
if ( mail($recipient_email, $subject, $email_body, $headers) ) {
    // Redirect to thank you page OR echo success
    header("Location: thank-you.html");
    exit;
} else {
    http_response_code(500);
    echo "Oops! Something went wrong and we couldn't send your message.";
}
?>
