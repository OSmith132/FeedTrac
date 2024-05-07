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


$course= $user_data["courseID"];

$users = $Feedback_Controller->list_users($course);




// Checks if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    // Get the form data
    $roomID = $_POST['roomID'];
    $urgency = $_POST['urgency'];
    $resolved = 0; // Some variables are defaulted to 0.
    $closed = 0; 
    $title = $_POST['title'];
    $text = $_POST['text'];


    // Calls new_feedback with the form data
    $Feedback_Controller->new_feedback($roomID, $urgency, $resolved, $closed, $title, $text);

    // Triggers a new alert for subbed users.
    foreach ($users as $user) { 
        if ($user['userID'] !== $user_data["userID"] && $user['sub'] == "1"){
        $Feedback_Controller->sub_alert($user['userID']);
        }
    }   
    
    // Redirects to index.php after submitting the form
    header("Location: index.php");
    exit;
    
}

?>

<!DOCTYPE html>
<html lang="en-gb">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>New Feedback - FeedTrac</title>

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
        <h1>Create New Feedback Page</h1>
    </main>

     <!-- Main -->
    <main>
        <div class="form">
            <!-- Sign-Up Form -->
            <h2>New Feedback</h2>

            <form action="newFeedback.php" method="post">
                <br>
                <?php
                    // Fetches all rooms to be valid options on the drop down selectioon
                    $rooms = $Feedback_Controller->list_rooms();

                    // Starts the select element
                    echo '<select name="roomID" required>';

                    // Adds a hidden option
                    echo '<option value="" selected disabled hidden>Room Number</option>';

                    // Loops through the rooms and creates an option for each
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
                <textarea name="text" required style="width: 435px; height: 100px;"placeholder="Add feedback..."></textarea>
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
    <?php include("footer.php"); ?>
</body>
</html>
