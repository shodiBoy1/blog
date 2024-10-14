<?php
require_once __DIR__ . '/vendor/autoload.php'; // Composer autoload
$Parsedown = new Parsedown();

// Function to get the first few lines of the markdown file (as a preview)
function get_post_preview($file_path, $lines = 3): string
{
    $content = file($file_path); // Read file into an array of lines
    return implode("", array_slice($content, 0, $lines)); // Return the first 3 lines
}

// Path to the markdown posts directory
// Path to the markdown posts directory
$md_dir = __DIR__ . '/md/';  // Go up one level and then access the md directory

echo 'Directory path: ' . $md_dir;


// Get all Markdown files in the directory
$posts = glob($md_dir . "*.md");


?>

<link rel="stylesheet" href="/assets/css/styles.css">

<?php include('templates/header.php'); ?>



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


<?php include('templates/footer.php'); ?>
</body>
</html>
