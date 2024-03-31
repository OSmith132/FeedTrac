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
                    $feedbackRows = $Feedback_Controller->get_all_feedback(); // THIS NEEDS TO BE CHANGED TO GET AL FEEDBACK FROM USER
                    ?>

                    <tr class="clickable-row" data-href="feedback.php">
                        <?php
                        foreach ($feedbackRows as $row) {

                        
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
            </div>
        </div>
    </main>
    <!-- Footer -->
    <?php include("footer.html"); ?>
</body>
</html>