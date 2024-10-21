document.addEventListener("DOMContentLoaded", function () {
    const welcomeText = [
        "Welcome to My Blog!",
        "Explore the latest insights on coding, tech, and self-improvement."
    ];

    let currentIndex = 0;
    let charIndex = 0;
    const speed = 100;
    let currentText = '';
    let displayedText = '';

    function type() {
        const typedText = document.getElementById('typed-text');

        currentText = welcomeText[currentIndex].substring(0, charIndex);

        typedText.innerHTML = displayedText + currentText;

        charIndex++;

        if (charIndex === welcomeText[currentIndex].length) {
            displayedText += currentText + '<br>';
            currentIndex++;
            charIndex = 0;

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

                subscribeMessage.innerHTML = `<p class="text-success">Thank you for subscribing!</p>`;
            })
            .catch(error => {
                const subscribeMessage = document.getElementById("subscribeMessage");

                subscribeMessage.innerHTML = `<p class="text-danger">There was an error. Please try again later.</p>`;
            });
    });
});


