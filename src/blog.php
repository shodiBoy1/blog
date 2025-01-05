<?php
require_once __DIR__ . '/../vendor/autoload.php';
$Parsedown = new Parsedown();

// Extend Parsedown to add ID attributes to headings for anchor links
class ParsedownWithAnchors extends Parsedown
{
    protected function blockHeader($Line)
    {
        $block = parent::blockHeader($Line);
        $text = $block['element']['text'];
        $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', trim($text)));
        $block['element']['attributes'] = ['id' => $slug];
        return $block;
    }
}

$Parsedown = new ParsedownWithAnchors();

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
            if (str_starts_with($line, 'date:')) {
                $metadata['date'] = trim(str_replace('date:', '', $line));
            } elseif (str_starts_with($line, 'tags:')) {
                $tags_string = trim(str_replace('tags:', '', $line));
                $metadata['tags'] = explode(',', $tags_string);
            }
        }
    }

    return $metadata;
}

// Function to save comments
function save_comment($post_name, $comment): void
{
    $file_path = __DIR__ . "/comments/{$post_name}_comments.txt";
    $comment_data = htmlspecialchars($comment) . "\n";
    file_put_contents($file_path, $comment_data, FILE_APPEND);
}

// Function to fetch comments
function get_comments($post_name): bool|array
{
    $file_path = __DIR__ . "/comments/{$post_name}_comments.txt";
    if (file_exists($file_path)) {
        return file($file_path, FILE_IGNORE_NEW_LINES);
    }
    return [];
}

// Function to handle likes
function increment_likes($post_name)
{
    $file_path = __DIR__ . "/likes/{$post_name}_likes.txt";
    $likes = 0;
    if (file_exists($file_path)) {
        $likes = (int)file_get_contents($file_path);
    }
    $likes++;
    file_put_contents($file_path, $likes);
    return $likes;
}

function get_likes($post_name)
{
    $file_path = __DIR__ . "/likes/{$post_name}_likes.txt";
    if (file_exists($file_path)) {
        return (int)file_get_contents($file_path);
    }
    return 0;
}
//  comment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment']) && isset($_POST['post_name'])) {
    $post_name = $_POST['post_name'];
    $comment = $_POST['comment'];
    save_comment($post_name, $comment);
    header("Location: /blog/$post_name");
    exit;
}   elseif (isset($_POST['like']) && isset($_POST['post_name'])) {
    $post_name = $_POST['post_name'];
    increment_likes($post_name);
    header("Location: /blog/$post_name");
    exit;
}


$md_dir = __DIR__ . '/md/';

if (isset($_GET['post'])) {
    $post_name = $_GET['post'];
    $post_path = $md_dir . $post_name . '.md';

    if (file_exists($post_path)) {
        $post_content = get_post_content($post_path);

        $post_content_without_metadata = preg_replace('/---(.*?)---/s', '', $post_content);

        $parsed_content = $Parsedown->text($post_content_without_metadata);

        require_once 'templates/header.php';
        echo "<div class='post'>";
        echo "<div class='post-content'>" . $parsed_content . "</div>";

        // comment section
        echo "<div class='comments-section'>";
        echo "<h3>Comments</h3>";
        echo "<form method='POST' action=''>";
        echo "<textarea name='comment' placeholder='Write your comment here...' required></textarea>";
        echo "<input type='hidden' name='post_name' value='" . htmlspecialchars($post_name) . "'>";
        echo "<button type='submit'>Submit Comment</button>";
        echo "</form>";

        $comments = get_comments($post_name);
        if (!empty($comments)) {
            echo "<ul class='comments-list'>";
            foreach ($comments as $comment) {
                echo "<li>" . htmlspecialchars($comment) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No comments yet. Be the first to comment!</p>";
        }
        echo "</div>";

        // Display likes
        $likes = get_likes($post_name);
        echo "<div class='likes-section'>";
        echo "<form method='POST' action=''>";
        echo "<input type='hidden' name='post_name' value='" . htmlspecialchars($post_name) . "'>";
        echo "<button type='submit' name='like' class='heart-button'>";
        echo "<i class='ri-heart-line'></i>";
        echo "</button>";
        echo "<span class='likes-count'>$likes</span>";
        echo "</form>";
        echo "</div>";

        echo "</div>";
        require_once 'templates/footer.php';
    } else {
        header("HTTP/1.0 404 Not Found");
        include('404.php');
    }
    exit;
}

$posts = glob($md_dir . "*.md");

// If filtering by tags
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
    if (!isset($_GET['post'])) {
        foreach ($posts as $post_path) {
            $post_name = basename($post_path, '.md');
            $metadata = get_post_metadata($post_path);

            echo "<div class='post'>";
            echo "<h2><a href='/blog/$post_name'>" . ucfirst(str_replace('_', ' ', $post_name)) . "</a></h2>";

            if (!empty($metadata['date'])) {
                echo "<p><strong>Published:</strong> " . htmlspecialchars($metadata['date']) . "</p>";
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
    }
    ?>
</div>

<?php include('templates/footer.php'); ?>
