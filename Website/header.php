<header>
    <div class="header-box">
        <a class="header-logo" href="index.php" title="Go to Homepage">
            <img id="header-icon" src="assets/icon.png" alt="FeedTrac Icon" width="32" height="32">
            <p class="header-logo-text">FeedTrac</p>
        </a>
    </div>

    <div class="header-box">
        <button id="colour-mode-button" class="header-button header-button-pointer" onclick="setColourMode(true)" title="Enable Light Mode">
            <i class="fa-solid fa-sun"></i>
        </button>

        <button id="home-button" class="header-button header-button-pointer" onclick="location.href = 'index.php'" title="Go to Homepage">
            <i class="fa-solid fa-house"></i>
        </button>

        <button id="inbox-button" class="header-button header-button-pointer" onclick="location.href = 'inbox.php'" title="Go to Inbox">
            <i class="fa-solid fa-inbox"></i>
            <span class="header-button-badge">5</span>
        </button>

        <div id="profile-button" class="header-dropdown">
            <img class="header-profile-picture" src="<?php
            // Get ID of current user
            $userID = $_SESSION['userID'];

            // Path to user's profile picture (either .jpg or .png)
            $jpg_path = "assets/profile-pictures/user-$userID.jpg";
            $png_path = "assets/profile-pictures/user-$userID.png";

            // Return valid path to user's profile picture (or the default profile picture)
            if (file_exists($jpg_path)) {
                echo $jpg_path;
            } elseif (file_exists($png_path)) {
                echo $png_path;
            } else {
                echo "assets/profile-pictures/user-default.jpg";
            }
            ?>" alt="User Profile Picture" width="30" height="30">

            <div class="header-dropdown-content">
                <button onclick="location.href = 'profile.php'" title="Go to Profile">Profile</button>
                <button onclick="location.href = 'settings.php'" title="Go to Settings">Settings</button>
                <button onclick="location.href = 'scripts/logout.php'" title="Logout">Logout</button>
            </div>
        </div>
    </div>
</header>

<script>
    window.onload = function() {
        if (!loggedIn) {
            console.log("HELLOOOOOOO");
            document.getElementById("home-button").hidden = true;
            document.getElementById("inbox-button").hidden = true;
            document.getElementById("profile-button").hidden = true;
        }
    };
</script>
