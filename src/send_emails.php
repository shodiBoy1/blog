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
$bodyTemplate = "Hello,\n\nHere's your bi-weekly update from my blog! Stay tuned for more updates.\n\n";
$bodyTemplate .= "If you wish to unsubscribe, click the link below:\n%s\n\n";
$bodyTemplate .= "Best regards,\nShodee";

// Load the email addresses and tokens from subscribers.txt
$file = __DIR__ . '/subscribers.txt';
$subscribers = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);  // Get emails and tokens as an array

// Set up PHPMailer
$mail = new PHPMailer(true);

try {
    // Enable verbose debug output for troubleshooting
    $mail->SMTPDebug  = 0;  // Set to 0 for no debug output

    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';  // Set the SMTP server (adjust for your provider)
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV['GMAIL_USERNAME'];  // Your Gmail address from .env
    $mail->Password   = $_ENV['GMAIL_PASSWORD'];  // Your Gmail app password from .env
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Sender info
    $mail->setFrom('shodeeblog@gmail.com', 'Shodee Blog');

    // Loop through each subscriber and send the message
    foreach ($subscribers as $subscriber) {
        // Split the email and token
        list($email, $token) = explode(',', $subscriber);

        // Generate the unsubscribe link
        $unsubscribeLink = "http://yourdomain.com/unsubscribe.php?token=" . urlencode($token);

        // Prepare the email body
        $body = sprintf($bodyTemplate, $unsubscribeLink);

        // Set email recipient, subject, and body
        $mail->addAddress($email);
        $mail->isHTML(false);  // Set email format to plain text
        $mail->Subject = $subject;
        $mail->Body    = $body;

        // Send the email
        $mail->send();

        // Clear all addresses for the next iteration
        $mail->clearAddresses();
        $mail->clearAttachments();
    }

    echo "Emails sent successfully.";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
