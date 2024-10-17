<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $token = bin2hex(random_bytes(16));

        $file = __DIR__ . '/subscribers.txt';

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


