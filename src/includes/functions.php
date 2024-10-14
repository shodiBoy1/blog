<?php
function fetchPostsFromDB() {
    global $conn;
    $query = "SELECT * FROM posts ORDER BY created_at DESC";
    $result = mysqli_query($conn, $query);

    $posts = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $posts[] = $row;
    }
    return $posts;
}
