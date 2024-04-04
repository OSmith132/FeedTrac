<?php

session_start();


include ("classes/Database.class.php");
include ("classes/login.class.php");
include ("classes/LoginContr.class.php");
include ("classes/Feedback.class.php");
include ("classes/FeedbackContr.class.php");
include ("scripts/functions.php");


$Login_Controller = new LoginContr();
$user_data = $Login_Controller->force_login();

$Feedback_Controller = new FeedbackContr($user_data['userID']);

?>

<!DOCTYPE html>
<html lang="en-gb">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>FeedTrac</title>

        <link rel="icon" type="image/x-icon" href="assets/icon.png">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="stylesheets/main.css">

        <script src="https://kit.fontawesome.com/7e1870387e.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <!-- Header -->
        <?php include("header.html"); ?>

        <!-- Main -->
        <main>
            <h1>Profile Page</h1><br>
            <h2>Profile page for User: <?php echo $_SESSION["userID"] ?></h2>
            <div class="profile-content">
                <div class="user-picture">
                    <h3>Profile Picture</h3>
                    <img class="avatar" src="assets/avatar.jpg" alt="User Avatar" height="200">
                </div>

                <div class="user-description">
                    <h3>About you:</h3>
                    <p>
                        Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit.
                        Obcaecati natus dolores harum.
                        Cum omnis veniam dolor odit totam delectus laboriosam enim.
                        Deserunt commodi porro odio temporibus veritatis pariatur enim vero!
                    </p>
                    <br>
                    <p>
                        Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit.
                        Eum nisi ea facilis!
                        Rem,
                        eos alias eaque labore in illum ea error quis ipsum dolorem hic,
                        cupiditate consectetur aliquid tempore ipsam.
                    </p>
                </div>

                <div class="user-data">
                <h3>Your data:</h3>
                    Email: [Email]<br><br>
                    Username: [Username]<br><br>
                    First Name: [First Name]<br><br>
                    Last Name: [Last Name]<br><br>
                    Year of Study: [Year of Study]<br><br>
                    Pronouns: [Pronouns]<br><br>
                    Position: [Position]<br><br>
                </div>
            </div>
            <div class="edit-profile">
                <div class="change-picture">
                    <form action="profile.php" method="post" enctype="multipart/form-data" class="upload-form">
                        <label for="profile-picture">Upload a profile picture:</label><br><br>
                        <input type="file" accept="image/*"><br><br>
                        <input type="submit" value="Upload">
                    </form>
                </div>
                <div class="edit-description">
                    <br><button class="profile-button">Edit About Section</button>
                </div>
                <div class="edit-data">
                    <br><button class="profile-button">Edit Personal Information</button>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <?php include("footer.html"); ?>
    </body>
</html>