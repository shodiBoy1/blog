<?php
include '../src/templates/header.php';
?>

<section id="hero" class="min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                <img src="../assets/images/noun-person-1067045.svg" class="img-fluid rounded-photo" alt="About Me Photo">
                <div id="about-text" class="mt-4 text-center">
                    <h2>About Me</h2>
                    <p>Hi, I'm Shodee, a computer science student and aspiring full-stack developer. I'm passionate about learning and improving my coding skills every day.</p>
                    <a href="/about" class="btn btn-dark">Learn More About Me</a>
                </div>

                <div id="subscribe" class="mt-5 text-center">
                    <h3>Subscribe to My Newsletter</h3>
                    <p>Get the latest updates directly in your inbox.</p>
                    <form id="subscribeForm"  class="rounded-form d-inline-flex">
                        <input type="email" name="email" class="form-control rounded-input" placeholder="Enter your email" required>
                        <button type="submit" class="btn btn-dark rounded-button">Subscribe</button>
                    </form>
                    <div id="subscribeMessage" class="mt-3"></div>
                </div>
            </div>

            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div id="welcome-text">
                    <h1 id="typed-text" class="typed"></h1>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../src/templates/footer.php'; ?>
