
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

?>


<!DOCTYPE html>
<html lang="en-gb">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>FeedTrac - Lights keep flickering during lecture</title>

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
        <main class="feedback-main">
            <div class="feedback-header">
                <button>Open</button>
                <a href="course.php"><button>Computer Science</button></a>
            </div>

            <h1>Lights keep flickering during lecture</h1>

            <div class="feedback-header">

                <p><img class="avatar" src="assets/avatar.jpg" alt="User Avatar" height="32"><a href="profile.php"> Archie Baldry (26411141)</a> raised this feedback 3 days ago · 2 comments</p>
                <!-- Heart Button -->
                <button id="heart-toggle" title="Like" onclick="like()">
                    <i id="heart-symbol" class="fa-regular fa-heart"></i> <div style="display:inline-block;" id=heart-counter>0</div>
                </button>
            </div>

            <div><hr></div>

            <div class="comment">
                <div class="comment-header">
                    <p><img class="avatar" src="assets/avatar.jpg" alt="User Avatar" height="32"><a href="profile.php"> Archie Baldry (26411141)</a> commented 3 days ago</p>
                </div>
                <div class="comment-main">
                    <p>I don't like how the lights keep flickering. It's hurting my eyes, pls fix.</p>
                </div>
            </div>

            <div class="comment">
                <div class="comment-header">
                    <p><img class="avatar" src="assets/avatar.jpg" alt="User Avatar" height="32"><a href="profile.php"> John Smith (11122233)</a> commented 2 days ago</p>
                </div>
                <div class="comment-main">
                    <p>Yeah ur right it is proper annoying.</p>
                </div>
            </div>

            <div><hr></div>

            <textarea class="feedback-comment" type="text" placeholder="Add Comment..."></textarea>
            <button class="feedback-button">Submit</button>
        </main> 

        <!-- Footer -->
        <?php include("footer.html"); ?>
    </body>
</html>
