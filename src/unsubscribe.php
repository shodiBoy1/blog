<?php

if (isset($_GET['token'])) {
    $token = filter_var($_GET['token'], FILTER_SANITIZE_STRING);

    // Path to the file where email addresses are saved
    $file = __DIR__ . '/subscribers.txt';

    // Load all subscribers into an array
    $subscribers = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $updatedSubscribers = [];
    $unsubscribed = false;

    // Iterate over each subscriber to find the matching token
    foreach ($subscribers as $subscriber) {
        list($email, $storedToken) = explode(',', $subscriber);

        if ($storedToken === $token) {
            // Found the subscriber, do not add to the updated list
            $unsubscribed = true;
            continue;
        }

        $updatedSubscribers[] = $subscriber;
    }

    if ($unsubscribed) {
        // Write the updated list back to the file
        if (file_put_contents($file, implode(PHP_EOL, $updatedSubscribers) . PHP_EOL)) {
            echo "You have successfully unsubscribed.";
        } else {
            echo "Error updating the subscription list. Please try again later.";
        }
    } else {
        echo "Invalid unsubscribe request.";
    }
} else {
    http_response_code(400);
    echo "No token provided.";
}


