<?php
require_once __DIR__ . '/../vendor/autoload.php';
$Parsedown = new Parsedown();

function get_post_content($file_path): string
{
    return file_get_contents($file_path);
}

function get_post_metadata($file_path): array
{
    $content = file_get_contents($file_path);

    preg_match('/---(.*?)---/s', $content, $matches);

    $metadata = [
        'date' => '',
        'tags' => []
    ];

    if (isset($matches[1])) {
        $lines = explode("\n", trim($matches[1]));

        foreach ($lines as $line) {
            if (strpos($line, 'date:') === 0) {
                $metadata['date'] = trim(str_replace('date:', '', $line));
            } elseif (strpos($line, 'tags:') === 0) {
                $tags_string = trim(str_replace('tags:', '', $line));
                $metadata['tags'] = explode(',', $tags_string);
            }
        }
    }

    return $metadata;
}

$md_dir = __DIR__ . '/md/';

if (isset($_GET['post'])) {
    $post_name = $_GET['post'];
    $post_path = $md_dir . $post_name . '.md';

    if (file_exists($post_path)) {
        $post_content = get_post_content($post_path);
        $parsed_content = $Parsedown->text($post_content);

        require_once 'templates/header.php';
        echo "<div class='post'>";
        echo "<div class='post-content'>" . $parsed_content . "</div>";
        echo "</div>";
        require_once 'templates/footer.php';
        exit;
    } else {
        header("HTTP/1.0 404 Not Found");
        include('404.php');
        exit;
    }
}

$posts = glob($md_dir . "*.md");

if (isset($_GET['tag'])) {
    $requested_tag = $_GET['tag'];

    $posts = array_filter($posts, function($post_path) use ($requested_tag) {
        $metadata = get_post_metadata($post_path);

        foreach ($metadata['tags'] as $tag) {
            if (strtolower(trim($tag)) === '#' . strtolower($requested_tag)) {
                return true;
            }
        }
        return false;
    });
}



?>

<link rel="stylesheet" href="/assets/css/styles.css">

<?php include('templates/header.php'); ?>

<div class="posts-list">
    <?php
    foreach ($posts as $post_path) {

        $post_name = basename($post_path, '.md');

        $metadata = get_post_metadata($post_path);

        echo "<div class='post'>";
        echo "<h2><a href='/blog/{$post_name}'>" . ucfirst(str_replace('_', ' ', $post_name)) . "</a></h2>";

        if (!empty($metadata['date'])) {
            echo "<p><strong>published:</strong> " . htmlspecialchars($metadata['date']) . "</p>";
        }

        if (!empty($metadata['tags'])) {
            echo "<p><strong></strong> ";
            foreach ($metadata['tags'] as $tag) {
                $tag_clean = str_replace('#', '', trim($tag));
                echo "<a href='/blog?tag=" . urlencode($tag_clean) . "'>" . htmlspecialchars($tag) . "</a> ";
            }
            echo "</p>";
        }



        echo "</div>";
    }
    ?>
</div>

<?php include('templates/footer.php'); ?>
