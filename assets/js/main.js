let color = localStorage.getItem("color");
if (color) document.body.className = color;

document.getElementById("color-button").addEventListener("click", function () {
    let newColor = document.body.className === "light" ? "dark" : "light";
    document.body.className = newColor;
    localStorage.setItem("color", newColor);
});
