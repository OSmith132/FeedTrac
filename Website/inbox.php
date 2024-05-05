<?php
session_start();

include("classes/Database.class.php");
include("classes/login.class.php");
include("classes/LoginContr.class.php");
include("classes/Feedback.class.php");
include("classes/FeedbackView.class.php");
include ("classes/FeedbackContr.class.php");
include("scripts/functions.php");

$Login_Controller = new LoginContr();
$user_data = $Login_Controller->force_login();
$Feedback_Controller = new FeedbackContr($user_data['userID']);
$Feedback_View = new FeedbackView($user_data['userID']);
$user = $user_data['userID'];

$dateTime = $user_data["accountDate"];
$feedbackRows = $Feedback_View->get_inbox_feedback($dateTime);

$Feedback_Controller->alert_reset($user);

// Define a comparison function for usort
function compare_by_date($a, $b) {
    return strtotime($b['modifiedDate']) - strtotime($a['modifiedDate']);
}

// Sort the feedback rows by modifiedDate
usort($feedbackRows, 'compare_by_date');



?>

<!DOCTYPE html> 
<html lang="en-gb">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inbox - FeedTrac</title>

    <link rel="icon" type="image/x-icon" href="assets/icon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="stylesheets/main.css">

    <style>
        tr[data-href] {
            cursor: pointer;
        }
    </style>

    <script src="https://kit.fontawesome.com/7e1870387e.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Header -->
    <?php include("header.php"); ?>

    <!-- Main -->
    <main>
        <h1>Inbox</h1>
        
        <div class="index-content">
            <div class="index-header">

                

            </div>


            <!-- Table to show feedback -->
            <table class="search-table">
            <tr>
        <th>Username</th>
        <th>Title</th>
        <th>Text</th>
        <th>Room ID</th>
        <th>Urgency</th>
        <th>Resolved</th>
        <th>Rating</th>
        <th>Date</th>
        <th>Last Updated</th>


        <th>Comments Count</th>
    </tr>
                <?php
                foreach ($feedbackRows as $row) {

                    $feedback_userID = $row["userID"];
                    $feedback_user_details = $Login_Controller->get_feedback_user_details($feedback_userID); 
                    $feedbackID =  $row["feedbackID"];
                    $comments = $Feedback_Controller->find_comments($feedbackID);
                    $comments_count = count($comments);                 

                    echo "<tr class='clickable-row' data-id='{$row['feedbackID']}'>";
                    echo "<td>{$feedback_user_details['username']}</td>";
                    echo "<td>{$row['title']}</td>";                    
                    echo "<td>{$row['text']}</td>";
                    echo "<td>{$row['roomID']}</td>";
                    echo "<td>{$row['urgency']}</td>";
                    echo "<td>{$row['resolved']}</td>";
                    echo "<td>{$row['ratingPoints']}</td>";
                    echo "<td>{$row['date']}</td>";
                    echo "<td>{$row['modifiedDate']}</td>";
                    echo "<td>{$comments_count}</td>";
                    echo "</tr>";
                }
                ?>
            </table>

        </div>
    </main>

    <!-- Footer -->
    <?php include("footer.php"); ?>
    <script>
    document.querySelector('.search-table').addEventListener('click', function(event) {
        // Select closest element with clickable-row to the clicked element
        var clickableRow = event.target.closest('.clickable-row');
        if (clickableRow) {
            // Get the data-id attribute
            var feedbackID = clickableRow.dataset.id;
            // Redirect to feedback.php with the ID as variable
            window.location.href = "feedback.php?id=" + feedbackID;
        }
    });
</script>

</body>

</html>
