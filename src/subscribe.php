<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the email address
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Generate a unique token for the subscriber
        $token = bin2hex(random_bytes(16));

        // Path to the file where email addresses are saved
        $file = __DIR__ . '/subscribers.txt';

        // Append the email and token to the file with a new line
        $subscriberData = $email . ',' . $token . PHP_EOL;
        if (file_put_contents($file, $subscriberData, FILE_APPEND | LOCK_EX)) {
            echo "success";
        } else {
            echo "Error writing to the file";
        }

    } else {
        http_response_code(400);
        echo "Invalid email address.";
    }
}


