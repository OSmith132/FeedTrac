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

function togglePasswordVisibility(passwordID) {
    const element = document.getElementById(passwordID);

    if (element.type === "password") {
        element.type = "text";
    } else {
        element.type = "password";
    }
}
