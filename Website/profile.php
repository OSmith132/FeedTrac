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

        <title><?php echo $Login_Controller->get_current_user_username();?> - FeedTrac</title>

        <link rel="icon" type="image/x-icon" href="assets/icon.png">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="stylesheets/main.css">

        <script src="https://kit.fontawesome.com/7e1870387e.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <!-- Header -->
        <?php include("header.php"); ?>

        <!-- Main -->
        <main>
            <h1><?php echo $Login_Controller->get_current_user_username();?></h1>

            <div class="profile-content">
                <div class="user-picture">
                    <h3>Profile Picture:</h3>
                    <img class="avatar" src="assets/avatar.jpg" alt="User Avatar" height="200">
                </div>

                <div class="user-description">
                    <h3>About:</h3>
                    <!-- TODO: Implement this in the database -->
                    <p>[User table currently doesn't support a user description or "about me"]</p>
                </div>

                <div class="user-data">
                    <h3>Personal Information:</h3>
                    <ul>
                        <li>Email: <?php echo $Login_Controller->get_current_user_email();?></li>
                        <li>Username: <?php echo $Login_Controller->get_current_user_username();?></li>
                        <li>First Name: <?php echo $Login_Controller->get_current_user_first_name();?></li>
                        <li>Last Name: <?php echo $Login_Controller->get_current_user_last_name();?></li>
                        <li>Year of Study: <?php echo $Login_Controller->get_current_user_study_year();?></li>
                        <li>Pronouns: <?php echo $Login_Controller->get_current_user_pronouns();?></li>
                        <li>Position: <?php echo $Login_Controller->get_current_user_position();?></li>
                    </ul>
                </div>
            </div>

            <div class="edit-profile">
                <div class="change-picture">
                    <form action="profile.php" method="post" enctype="multipart/form-data" class="upload-form">
                        <label for="profile-picture">Upload a profile picture:</label><br>
                        <input type="file" accept="image/*"><br>
                        <input type="submit" value="Upload" class="profile-button">
                    </form>
                </div>

                <div class="edit-description">
                    <button class="profile-button">Edit About Section</button>
                </div>

                <div class="edit-data">
                    <button class="profile-button">Edit Personal Information</button>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <?php include("footer.html");?>
    </body>
</html>
