document.addEventListener("DOMContentLoaded", function () {
    const welcomeText = [
        "Welcome to My Blog!",
        "Explore the latest insights on coding, tech, and self-improvement."
    ];

    let currentIndex = 0;
    let charIndex = 0;
    const speed = 100; // Typing speed
    let currentText = '';
    let displayedText = ''; // Variable to store the text already displayed

    function type() {
        const typedText = document.getElementById('typed-text');

        // Get the current text being typed
        currentText = welcomeText[currentIndex].substring(0, charIndex);

        // Display previously typed text + currently typing text
        typedText.innerHTML = displayedText + currentText;

        charIndex++;

        // When the current text is fully typed
        if (charIndex === welcomeText[currentIndex].length) {
            displayedText += currentText + '<br>'; // Store the completed text and add line break
            currentIndex++;
            charIndex = 0;

            // Stop typing if all messages are complete
            if (currentIndex === welcomeText.length) {
                clearInterval(typingInterval);
            }
        }
    }

    const typingInterval = setInterval(type, speed);
});


document.addEventListener("DOMContentLoaded", function () {
    const subscribeForm = document.getElementById("subscribeForm");

    subscribeForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(subscribeForm);
        const email = formData.get("email");


        fetch("/src/subscribe.php", {
            method: "POST",
            body: formData,
        })
            .then(response => response.text())
            .then(data => {
                const subscribeMessage = document.getElementById("subscribeMessage");

                // Display success or error message
                subscribeMessage.innerHTML = `<p class="text-success">Thank you for subscribing!</p>`;
            })
            .catch(error => {
                const subscribeMessage = document.getElementById("subscribeMessage");

                // Display an error message
                subscribeMessage.innerHTML = `<p class="text-danger">There was an error. Please try again later.</p>`;
            });
    });
});


