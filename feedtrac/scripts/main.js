function darkMode() {
    // change the background color
    let element = document.body;
    element.className = "dark-mode";

    // Change the button and icon
    let button = document.getElementById("lightbulb-toggle");
    let content = document.getElementById("lightbulb-symbol");
    button.title = "Toggle Dark Mode";
    button.onclick = lightMode; 
    content.className = "fa-regular fa-lightbulb";
}

function lightMode() {
    // change the background color
    let element = document.body;
    element.className = "light-mode";

    // Change the button and icon
    let button = document.getElementById("lightbulb-toggle");
    let content = document.getElementById("lightbulb-symbol");
    button.title = "Toggle Light Mode";
    button.onclick = darkMode; // Assign function reference
    content.className = "fa-solid fa-lightbulb";
}

// For making table rows with an href clickable
function clickableRow() {
    const rows = document.querySelectorAll(".clickable-row");
    rows.forEach(row => {
        row.addEventListener("click", () => {
            window.location.href = row.dataset.href;
        });
    });
}

// Old Functions
// function darkMode() {
//     let element = document.body;
//     let content = document.getElementById("DarkModetext");
//     element.className = "dark-mode";
//     content.innerText = "Dark Mode is ON";
// }
// function lightMode() {
//     let element = document.body;
//     let content = document.getElementById("DarkModetext");
//     element.className = "light-mode";
//     content.innerText = "Dark Mode is OFF";
// }