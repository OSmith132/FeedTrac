<?php
// Boolean
// True  - User is logged in
// False - User is NOT logged in
$logged_in = isset($_SESSION["userID"]);

// Number of alerts the current user has (defaults to 0)
$alerts_count = 0;

// Path used by profile button image (defaults to "user-default.jpg")
$avatar_path = "assets/profile-pictures/user-default.jpg";

if ($logged_in) {
    // Get the current user's ID
    $user_id = $_SESSION["userID"];

    // TODO: Get the current user's number of alerts
    $alerts_count = 69420;

    // ----------------------------------------------------
    // Get the current user's avatar (favours JPG over PNG)
    $jpg_path = "assets/profile-pictures/user-$user_id.jpg";

    if (file_exists($jpg_path)) {
        $avatar_path = $jpg_path;
    } else {
        $png_path = "assets/profile-pictures/user-$user_id.png";

        if (file_exists($png_path)) {
            $avatar_path = $png_path;
        }
    }
    // ----------------------------------------------------
}
?>

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

        <button class="header-button header-button-pointer" onclick="location.href = 'index.php'" title="Go to Homepage" <?php if (!$logged_in) echo "style='display: none;'"; ?>>
            <i class="fa-solid fa-house"></i>
        </button>

        <button class="header-button header-button-pointer" onclick="location.href = 'inbox.php'" title="Go to Inbox" <?php if (!$logged_in) echo "style='display: none;'"; ?>>
            <i class="fa-solid fa-inbox"></i>

            <!-- Hide the alert badge when there are no alerts -->
            <?php if ($alerts_count > 0) echo "<span class='header-button-badge'>$alerts_count</span>"; ?>
        </button>

        <div class="header-dropdown" <?php if (!$logged_in) echo "style='display: none;'"; ?>>
            <img class="header-profile-picture" src="<?php echo $avatar_path; ?>" alt="User Profile Picture" width="30" height="30">

            <div class="header-dropdown-content">
                <button onclick="location.href = 'profile.php'" title="Go to Profile">Profile</button>
                <button onclick="location.href = 'settings.php'" title="Go to Settings">Settings</button>
                <button onclick="location.href = 'scripts/logout.php'" title="Logout">Logout</button>
            </div>
        </div>
    </div>
</header>
