<?php

session_start();

include("classes/Database.class.php");
include("scripts/functions.php");

$database = new database();

$user_data = $database->check_login();





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
    <div class="header">
        <a class="logo" title="Homepage" href="index.php">
            <img src="assets/icon.png" alt="FeedTrac Icon" height="32">

            <h1>FeedTrac</h1>
        </a>

        <div class="header-right">
            <button title="Toggle Dark Mode" id="lightbulb-toggle" onclick="lightMode()"> <!-- Frontend crew might want to change the id to a class if you want to use this function for multiple elements -->
                <i id="lightbulb-symbol" class="fa-regular fa-lightbulb"></i>
            </button>

            <button title="Inbox">
                <i class="fa-solid fa-inbox"></i>
            </button>

            <a title="Profile" href="#">
                <img class="avatar" src="assets/avatar.jpg" alt="User Avatar" height="32">
            </a>
        </div>
    </div>

    <div class="main">
        <div class="list-header">
            <input class="search-bar" type="text" placeholder="Filter existing Feedback...">

            <button>New Feedback</button>
        </div>

        <div class="table">
            <table>

                <!-- Table Headers -->
                <tr>
                    <th>Status</th> <!-- Resolved + Urgency -->
                    <th>Title</th>
                    <th>Text</th> <!-- Short snippet of feedback content -->
                    <th>Date</th>
                    <th>Rating Points</th> <!-- RatingPoints -->
                    <th>Coments</th> <!-- Number of comments -->
                </tr>


                <!-- Get result from database to fill table -->
                <?php
                 $feedbackRows = $database->query("SELECT resolved, urgency, title, `feedback`.text, `feedback`.date, `feedback`.ratingPoints, COUNT(commentID) as number_of_comments FROM `feedback` LEFT JOIN `comment` ON `feedback`.feedbackID = `comment`.feedbackID GROUP BY `feedback`.feedbackID;");
                ?>


                <tr class="clickable-row" data-href="feedback.php">
                    <?php
                    while ($row = mysqli_fetch_assoc($feedbackRows)) {
                    ?>
                        <td><?php echo  $get_resolved_string[$row['resolved']] . "<br>"      // Resolved Status - Refer to functins.php for the array
                                . $get_urgency_string[$row['urgency']] . " Urgency"; // Urgency Level   - Refer to functins.php for the array
                            ?>
                        </td>

                        <td><?php echo shorten($row['title'], 50); ?></td>
                        <td><?php echo shorten($row['text'], 75); ?></td> <!-- shortens the text to 15 characters -->
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['ratingPoints']; ?></td>
                        <td><?php echo $row['number_of_comments']; ?></td>
                </tr>

            <?php
                    }
            ?>

            <script>
                const rows = document.querySelectorAll(".clickable-row");
                rows.forEach(row => {
                    row.addEventListener("click", () => {
                        window.location.href = row.dataset.href;
                    });
                });

            </script>

            <style>
                tr[data-href] {
                    cursor: pointer;
                }
            </style>






            </table>

            <div class="footer">
                <p>© 2024 The FeedTrac Team</p>

                <a href="#">Terms</a>

                <a href="#">Privacy</a>

                <a href="https://github.com/OSmith132/FeedTrac/">Source</a>

                <a href="#">Contact</a>
            </div>
        </div>

        <script src="scripts/main.js"></script>
</body>

</html>