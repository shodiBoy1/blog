<?php
require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$subject = "Bi-Weekly Update from My Blog";

// **Load content links from a file and format them in HTML**
$contentLinksFile = __DIR__ . '/emails_content/content_links.txt';
echo "Content Links File Path: " . $contentLinksFile . PHP_EOL;
if (!file_exists($contentLinksFile)) {
    die("Error: content_links.txt file not found.");
}
$contentLinks = file($contentLinksFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$contentLinksHtml = implode('<br>', array_map(fn($link) => "<a href=\"$link\">$link</a>", $contentLinks));

// **Load the HTML template**
$templateFile = realpath(__DIR__ . '/emails_content/post_template.php');
if (!$templateFile) {
    die("Template file not found");
}
$templateContent = file_get_contents($templateFile);



// **Load subscriber emails and tokens**
$file = __DIR__ . '/subscribers.txt';
$subscribers = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

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

    // Loop through each subscriber to send personalized emails
    foreach ($subscribers as $subscriber) {
        list($email, $token) = explode(',', $subscriber);

        // **Generate the unsubscribe link**
        $unsubscribeLink = "https://shodeeblog.com/src/unsubscribe?token=" . urlencode($token);

        // **Replace placeholders in the template with actual data**
        $body = str_replace(
            ['{{POST_PREVIEW}}', '{{UNSUBSCRIBE_LINK}}'],
            [$contentLinksHtml, $unsubscribeLink],
            $templateContent
        );

        $mail->addAddress($email);
        $mail->isHTML(true);
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
