<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Composer autoload
$Parsedown = new Parsedown();

// Function to get the full content of the markdown file
function get_post_content($file_path): string
{
    return file_get_contents($file_path); // Return the full content of the file
}

// Function to get the first few lines of the markdown file (as a preview)
function get_post_preview($file_path, $lines = 3): string
{
    $content = file($file_path); // Read file into an array of lines
    return implode("", array_slice($content, 0, $lines)); // Return the first 3 lines
}

// Path to the markdown posts directory
$md_dir = __DIR__ . '/md/';

// Check if a specific post is requested
if (isset($_GET['post'])) {
    $post_name = $_GET['post'];
    $post_path = $md_dir . $post_name . '.md';

    // Check if the file exists
    if (file_exists($post_path)) {
        $post_content = get_post_content($post_path); // Get the full content of the post
        $parsed_content = $Parsedown->text($post_content); // Parse the markdown

        // Display the full post
        require_once 'templates/header.php';
        echo "<div class='post'>";
        //echo "<h2>" . ucfirst(str_replace('_', ' ', $post_name)) . "</h2>";
        echo "<div class='post-content'>" . $parsed_content . "</div>";
        echo "</div>";
        require_once 'templates/footer.php';
        exit;
    } else {
        // Post not found, show a 404 error
        header("HTTP/1.0 404 Not Found");
        include('404.php');
        exit;
    }
}

// If no specific post is requested, show all posts with previews
$posts = glob($md_dir . "*.md");

?>

<link rel="stylesheet" href="/assets/css/styles.css">

<?php include('templates/header.php'); ?>

<div class="posts-list">
    <?php
    // Loop through each markdown post and display its title and preview
    foreach ($posts as $post_path) {

        // Extract post name from the file path
        $post_name = basename($post_path, '.md');

        // Get the first few lines of the post as a preview
        $preview = get_post_preview($post_path, 3);

        // Display the post title and preview
        echo "<div class='post'>";
        echo "<h2><a href='/blog/{$post_name}'>" . ucfirst(str_replace('_', ' ', $post_name)) . "</a></h2>";
        echo "<p>" . htmlspecialchars($preview) . "...</p>";
        echo "</div>";
    }
    ?>
</div>

<?php include('templates/footer.php'); ?>
