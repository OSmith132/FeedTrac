<?php
$logged_in = isset($_SESSION["userID"]);

$avatar_path = "assets/profile-pictures/user-default.jpg";

if ($logged_in) {
    $user_id = $_SESSION["userID"];

    $jpg_path = "assets/profile-pictures/user-$user_id.jpg";

    if (file_exists($jpg_path)) {
        $avatar_path = $jpg_path;
    } else {
        $png_path = "assets/profile-pictures/user-$user_id.png";

        if (file_exists($png_path)) {
            $avatar_path = $png_path;
        }
    }
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
            <span class="header-button-badge">5</span>
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
