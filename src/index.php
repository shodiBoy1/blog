<?php
require_once ('includes/global.php');
// Include the header template
include '../src/templates/header.php';
?>

<!-- HERO SECTION WITH TYPING EFFECT AND ABOUT ME SECTION -->
<section id="hero" class="min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row">
            <!-- Left Column: About Me Section with Photo and Subscribe Form -->
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                <img src="/assets/images/profile-pic.png" class="img-fluid rounded-photo" alt="About Me Photo">
                <div id="about-text" class="mt-4 text-center">
                    <h2>About Me</h2>
                    <p>Hi, I'm Shodee, a computer science student and aspiring software developer. I'm passionate about learning and improving my coding skills every day.</p>
                    <a href="/about" class="btn btn-dark">Learn More About Me</a>
                </div>

                <!-- Subscribe Form placed after About Me section -->
                <div id="subscribe" class="mt-5 text-center">
                    <h3>Subscribe to My Newsletter</h3>
                    <p>Get the latest updates directly in your inbox.</p>
                    <form id="subscribeForm"  class="rounded-form d-inline-flex">
                        <input type="email" name="email" class="form-control rounded-input" placeholder="Enter your email" required>
                        <button type="submit" class="btn btn-dark rounded-button">Subscribe</button>
                    </form>
                    <div id="subscribeMessage" class="mt-3"></div> <!-- Success message will appear here -->
                </div>
            </div>

            <!-- Right Column: Welcome Text with Typing Effect -->
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div id="welcome-text">
                    <h1 id="typed-text" class="typed"></h1>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<?php
// Include the footer template
include '../src/templates/footer.php';
?>
