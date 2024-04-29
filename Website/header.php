<header>
    <a class="logo" title="Homepage" href="index.php">
        <img src="assets/icon.png" alt="FeedTrac Icon" height="32">

        <h1>FeedTrac</h1>
    </a>

    <div class="header-right">

        <!-- Light/dark Mode switch -->
        <button title="Toggle Dark Mode" id="lightbulb-toggle" onclick="lightMode()"> <!-- Frontend crew might want to change the id to a class if you want to use this function for multiple elements -->
            <i id="lightbulb-symbol" class="fa-regular fa-lightbulb"></i>
        </button>

        <!-- Home Button -->
        <button title="Home" id="home-button" style="display: none;" onclick="window.location.href = 'index.php'">
            <i class="fa-solid fa-house"></i>
        </button>

        <!-- Inbox Button -->
        <button title="Inbox" id="inbox-button" style="display: none;" onclick="window.location.href = 'inbox.php'">
            <i class="fa-solid fa-inbox"></i>
        </button>

        <!-- Profile -->
        <div class="dropdown">
            <a title="Profile" id="profile-button" href="#" style="display: none;">
                <img style="margin-right: 10px;" class="avatar" src="<?php 
                                                // Get user info and find either jpg or png profile picture
                                                $userID = $_SESSION['userID'];
                                                $jpg_path = "assets/profile-pictures/user-$userID.jpg";
                                                $png_path = "assets/profile-pictures/user-$userID.png";
                                    
                                                // Return 
                                                if (file_exists($jpg_path)) {
                                                    echo $jpg_path;
                                                } elseif (file_exists($png_path)) {
                                                    echo $png_path;
                                                } else {
                                                    echo "assets/profile-pictures/user-default.jpg";
                                                }?>"
                                            alt="User Avatar" height="32" href="profile.php">
            </a>
            <div class="dropdown-content">
                <br>
                <!-- Profile Button -->
                <button title="Profile" onclick="window.location.href = 'profile.php'">
                    <i class="fa-solid fa-user"></i>
                </button>
                <br><br>
                <!-- Settings Button -->
                <button title="Settings" onclick="window.location.href = 'settings.php'">
                    <i class="fa-solid fa-gear"></i>
                </button>
                <br><br>
                <!-- Logout Button -->
                <button title="Logout" id="logout-button" onclick="window.location.href = 'scripts/logout.php'">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </button>
            </div>
        </div>
    </div>
</header>
<hr>

<!-- JavaScript to show buttons when logged in -->
<script>
    window.onload = function(){
        if (loggedIn){
          document.getElementById("inbox-button").style.display = "inline";
          document.getElementById("home-button").style.display = "inline";
          document.getElementById("profile-button").style.display = "inline";
        }
    };
</script>