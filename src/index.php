<?php
require_once __DIR__ . '/includes/global.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG.</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">
    <!-- Bootstrap and RemixIcon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <!-- Fancybox -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>

<div class="wrapper d-flex flex-column min-vh-100">

    <!-- Include the header -->
    <?php include('templates/header.php'); ?>

    <!-- MAIN CONTENT -->
    <main class="flex-grow-1 py-5">
        <div class="container">
            <h1>Welcome to my Personal Blog</h1>
            <p>This is your main content area. Add your content here...</p>
        </div>
    </main>

    <!-- Include the footer -->
    <?php include('templates/footer.php'); ?>

</div>

<!-- External Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="/assets/js/main.js"></script>

</body>
</html>
