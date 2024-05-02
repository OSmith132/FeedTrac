<header>
    <div class="header-box">
        <a class="header-logo" href="index.php" title="Go to Homepage">
            <img src="assets/icon.png" alt="FeedTrac Icon" width="32" height="32">
            <p class="header-logo-text">FeedTrac</p>
        </a>
    </div>

    <div class="header-box">
        <button class="header-button header-button-pointer" onclick="location.href = 'index.php'" title="Enable Light Mode">
            <i class="fa-solid fa-sun"></i>
        </button>

        <button class="header-button header-button-pointer" onclick="" title="Go to Homepage">
            <i class="fa-solid fa-house"></i>
        </button>

        <div class="header-dropdown">
            <button class="header-button">
                <i class="fa-solid fa-inbox"></i>
                <span class="header-button-badge">5</span>
            </button>

            <div class="header-dropdown-content header-dropdown-content-wide">
                <button onclick="console.log('Placeholder')">Alert Example 1 - Crazy alert example that takes up a lot of space</button>
                <button onclick="console.log('Placeholder')">Alert Example 2 - Crazy alert example that takes up a lot of space</button>
                <button onclick="console.log('Placeholder')">Alert Example 3 - Crazy alert example that takes up a lot of space</button>
                <button onclick="console.log('Placeholder')">Alert Example 4 - Crazy alert example that takes up a lot of space</button>
                <button onclick="console.log('Placeholder')">Alert Example 5 - Crazy alert example that takes up a lot of space</button>
            </div>
        </div>

        <div class="header-dropdown">
            <!-- TODO: Reimplement custom user profile picture. Please do this with a dedicated function, rather than writing a load of PHP here. -->
            <img class="header-profile-picture" src="assets/profile-pictures/user-default.jpg" alt="User Profile Picture" width="30" height="30">

            <div class="header-dropdown-content">
                <button onclick="location.href = 'profile.php'">Profile</button>
                <button onclick="location.href = 'settings.php'">Settings</button>
                <button onclick="location.href = 'scripts/logout.php'">Logout</button>
            </div>
        </div>
    </div>
</header>
