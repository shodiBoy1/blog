<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the email address
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Path to the file where email addresses are saved
        $file = __DIR__ . '/subscribers.txt';

        // Append the email to the file with a new line
        if (file_put_contents($file, $email . PHP_EOL, FILE_APPEND | LOCK_EX)) {
            echo "success";
        } else {
            echo "Error writing to the file";
        }

    } else {
        http_response_code(400);
        echo "Invalid email address.";
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo "Method not allowed.";
}
