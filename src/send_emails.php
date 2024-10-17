<?php
require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$subject = "Bi-Weekly Update from My Blog";
$bodyTemplate = "Hello,\n\nHere's your bi-weekly update from my blog! Stay tuned for more updates.\n\n";
$bodyTemplate .= "If you wish to unsubscribe, click the link below:\n%s\n\n";
$bodyTemplate .= "Best regards,\nShodee";

$file = __DIR__ . '/subscribers.txt';
$subscribers = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);  // Get emails and tokens as an array

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug  = 0;

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV['GMAIL_USERNAME'];
    $mail->Password   = $_ENV['GMAIL_PASSWORD'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('shodeeblog@gmail.com', 'Shodee Blog');

    foreach ($subscribers as $subscriber) {
        list($email, $token) = explode(',', $subscriber);

        $unsubscribeLink = "http://yourdomain.com/unsubscribe.php?token=" . urlencode($token);

        $body = sprintf($bodyTemplate, $unsubscribeLink);

        $mail->addAddress($email);
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();

        $mail->clearAddresses();
        $mail->clearAttachments();
    }

    echo "Emails sent successfully.";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
