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



// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    // Get the form data
    $roomID = $_POST['roomID'];
    $date = date("Y-m-d");
    $urgency = $_POST['urgency'];
    $resolved = 0; // Set this based on your form data
    $closed = 0; // Set this based on your form data
    $title = $_POST['title'];
    $text = $_POST['text'];

  
        // Call new_feedback with the form data
        $Feedback_Controller->new_feedback($roomID, $date, $urgency, $resolved, $closed, $title, $text);
        $Feedback_Controller->sub_alert();


    
    
}

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
        <?php include("header.php"); ?>

        <!-- Main -->
        <main><h1>Create New Feedback Page</h1></main>
         <!-- Main -->
		<main>

<div class="form">

    <!-- Sign-Up Form -->
    <h2>New Feedback</h2>
    <form action="newFeedback.php" method="post">
    
        <br>
        <?php
            // Fetch all rooms
            $rooms = $Feedback_Controller->list_rooms();

            // Start the select element
            echo '<select name="roomID" required>';

            // Add a hidden option
            echo '<option value="" selected disabled hidden>Room Number</option>';

            // Loop through the rooms and create an option for each
            foreach ($rooms as $room) {
                echo '<option value="' . $room['roomID'] . '">' . $room['roomName'] . '</option>';
            }

            // End the select element
            echo '</select>';
        ?>
         <br><br>

        Title:<br>
        <input type="text" name="title" required>
        <br><br>

        Enter your feedback:<br>
        <input type="text" name="text" required>
        <br><br>
        
        <select name="urgency" required>
            <option value = ""selected disabled hidden>Urgency</option>
            <option value="0">Low</option>
            <option value="1">Medium</option>
            <option value="2">High</option>
            <option value="3">Critical</option>
        </select><br><br>

        <input type="submit" value="Submit">
    </form>
</div>
</main>

        <!-- Footer -->
        <div class="footer-position"><?php include("footer.php"); ?></div>
    </body>
</html>