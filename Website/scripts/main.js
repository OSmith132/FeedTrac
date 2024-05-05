// Set colour mode based on local storage (defaults to dark mode)
document.addEventListener("DOMContentLoaded", function() {
    if (localStorage.getItem("colourMode") === "light") {
        setColourMode(true);
    } else {
        setColourMode(false);
    }
});

// Set dark/light mode
function setColourMode(lightMode) {
    const root = document.querySelector(":root");

    const headerIcon = document.getElementById("header-icon");
    const colourModeButton = document.getElementById("colour-mode-button");

    if (lightMode) {
        // ENABLE LIGHT MODE

        // Update root variables
        root.style.setProperty("--a", "#eee");
        root.style.setProperty("--b", "#ddd");
        root.style.setProperty("--c", "#ccc");
        root.style.setProperty("--d", "#bbb");
        root.style.setProperty("--e", "#999");
        root.style.setProperty("--f", "#555");
        root.style.setProperty("--g", "#111");

        // Update header icon
        headerIcon.style.filter = "invert(1)";

        // Update toggle button
        colourModeButton.setAttribute("onclick", "setColourMode(false)")
        colourModeButton.setAttribute("title", "Enable Dark Mode");
        colourModeButton.innerHTML = "<i class='fa-solid fa-moon'></i>";

        // Update local storage
        localStorage.setItem("colourMode", "light");
    } else {
        // ENABLE DARK MODE

        // Update root variables
        root.style.setProperty("--a", "#111");
        root.style.setProperty("--b", "#222");
        root.style.setProperty("--c", "#333");
        root.style.setProperty("--d", "#444");
        root.style.setProperty("--e", "#666");
        root.style.setProperty("--f", "#aaa");
        root.style.setProperty("--g", "#eee");

        // Update header icon
        headerIcon.style.filter = null;

        // Update toggle button
        colourModeButton.setAttribute("onclick", "setColourMode(true)")
        colourModeButton.setAttribute("title", "Enable Light Mode");
        colourModeButton.innerHTML = "<i class='fa-solid fa-sun'></i>";

        // Update local storage
        localStorage.setItem("colourMode", "dark");
    }
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
    document.getElementById("like_post").click()
}

function unlike() {
    let button = document.getElementById("heart-toggle");
    let content = document.getElementById("heart-symbol");
    let counter = document.getElementById("heart-counter");

    button.title = "Like"
    content.className = "fa-regular fa-heart";
    counter = counter.textContent--;
    button.onclick = like;
    document.getElementById("like_post").click()
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
function openForm(formID) {
    document.getElementById(formID).style.visibility = "visible"
    document.getElementById(formID).style.opacity = 1;
}

//Close form
function closeForm(formID) {
    setTimeout(function() {
        document.getElementById(formID).style.visibility = "hidden";
    }, 300);
    document.getElementById(formID).style.opacity = 0;
}

// Show/hide characters in password input
function togglePasswordVisibility(passwordID) {
    const element = document.getElementById(passwordID);

    if (element.type === "password") {
        element.type = "text";
    } else {
        element.type = "password";
    }
}
