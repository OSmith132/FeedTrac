<?php
session_start();

include("classes/Database.class.php");
include("classes/login.class.php");
include("classes/LoginContr.class.php");
include("classes/Feedback.class.php");
include("classes/FeedbackView.class.php");
include("scripts/functions.php");

$Login_Controller = new LoginContr();
$user_data = $Login_Controller->force_login();

$Feedback_View = new FeedbackView($user_data['userID']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Feedback 404 - FeedTrac</title>

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
    <main class="feedback404-main">
        <h1>This feedback doesn't exist!</h1>

        <p>Perhaps the feedback you were trying to access has been deleted?</p>

        <button class="accent-button" onclick="location.href = 'index.php';">Return to the Homepage</button>
    </main>

    <!-- Footer -->
    <?php include("footer.php"); ?>
</body>
</html>
