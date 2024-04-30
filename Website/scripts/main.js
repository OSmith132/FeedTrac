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

// Heart button functions
function like() {
    let button = document.getElementById("heart-toggle");
    let content = document.getElementById("heart-symbol");
    let counter = document.getElementById("heart-counter");

    button.title = "Unlike"
    content.className = "fa-solid fa-heart";
    counter = counter.textContent++;
    button.onclick = unlike;
}

function unlike() {
    let button = document.getElementById("heart-toggle");
    let content = document.getElementById("heart-symbol");
    let counter = document.getElementById("heart-counter");

    button.title = "Like"
    content.className = "fa-regular fa-heart";
    counter = counter.textContent--;
    button.onclick = like;
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

//Settings.php popup form
//Open form
function openForm() {
    document.getElementById("deletion-form").style.visibility = "visible"
    document.getElementById("deletion-form").style.opacity = 1;
}

//Close form
function closeForm() {
    setTimeout(function() {
        document.getElementById("deletion-form").style.visibility = "hidden";
    }, 300);
    document.getElementById("deletion-form").style.opacity = 0;
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