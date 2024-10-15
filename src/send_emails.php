<?php
require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Load environment variables from .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Email content
$subject = "Bi-Weekly Update from My Blog";
$body = "Hello,\n\nHere's your bi-weekly update from my blog! Stay tuned for more updates.\n\nBest regards,\nShodee";

// Load the email addresses from subscribers.txt
$file = __DIR__ . '/subscribers.txt';
$emails = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);  // Get emails as an array

// Set up PHPMailer
$mail = new PHPMailer(true);

try {
    // Enable verbose debug output for troubleshooting
    $mail->SMTPDebug  = 2;  // Set to 0 for no debug output (change to 2 for detailed debug info)

    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';  // Set the SMTP server (adjust for your provider)
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV['GMAIL_USERNAME'];  // Your Gmail address from .env
    $mail->Password   = $_ENV['GMAIL_PASSWORD'];  // Your Gmail app password from .env
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Sender info
    $mail->setFrom('shodeeblog@gmail.com', 'Shodee Blog');

    // Loop through each email and send the message
    foreach ($emails as $email) {
        $mail->addAddress($email);  // Add recipient

        $mail->isHTML(false);  // Set email format to plain text
        $mail->Subject = $subject;
        $mail->Body    = $body;

        // Send the email
        $mail->send();

        // Clear all addresses for the next iteration
        $mail->clearAddresses();
        $mail->clearAttachments();  // Clear any attachments (optional)
    }

    echo "Emails sent successfully.";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
