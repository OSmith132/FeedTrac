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

        <style>tr[data-href]{cursor: pointer;}</style>

        <script src="https://kit.fontawesome.com/7e1870387e.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <!-- Header -->
        <?php include("header.html"); ?>

        <!-- Main -->
        <main>
            <h1>[Show feedback items relevant to the user's course]</h1>
            <div class="index-main">
                <div class="index-header">
                    <input class="search-bar" type="text" placeholder="Filter existing Feedback...">

                    <button onclick="window.location.href = 'newFeedback.php'">New Feedback</button>
                </div>

                <div class="table" class="center">
                    <table>

                        <!-- Table Headers -->
                        <tr>
                            <th>Status</th> <!-- Resolved + Urgency -->
                            <th>Title</th> <!-- Title -->
                            <th>Text</th> <!-- Text -->
                            <th>Date</th> <!-- Date -->
                            <th>Rating Points</th> <!-- RatingPoints -->
                            <th>Comments</th> <!-- Number of comments -->
                            <th>Course</th> <!-- Course -->
                            <th>Author</th> <!-- Author -->
                        </tr>


                        <!-- Get result from database to fill table -->
                        <?php
                        $feedbackRows = $Feedback_Controller->get_all_feedback(); // NEED TO ADD FILTERS HERE ----------------------------
                        ?>




                        
                            <?php
                            foreach ($feedbackRows as $row) {
                                $userInfo = $Feedback_Controller->get_user_info($row['feedbackID']);
                            ?>



                                <tr class="clickable-row" data-href="feedback.php">
                               
                                    <td>
                                        <?php echo  $get_resolved_string[$row['resolved']] . "<br>"      // Resolved Status - Refer to functions.php for the array
                                            . $get_urgency_string[$row['urgency']] . " Urgency"; // Urgency Level   - Refer to functins.php for the array
                                        ?>
                                    </td>

                                    <td><?php echo shorten($row['title'], 50); ?></td> <!-- shortens the title to 50 characters -->
                                    <td><?php echo shorten($row['text'], 75); ?></td>  <!-- shortens the text to 15 characters -->
                                    <td><?php echo $row['date']; ?></td>               <!-- Date -->
                                    <td><?php echo $row['ratingPoints']; ?></td>       <!-- Rating Points -->
                                    <td><?php echo $row['number_of_comments']; ?></td> <!-- Number of comments -->
                                    <td>course</td>
                                    <td href="profile.php">                                               
                                        <div style="display: flex;"  >  <!-- MAKE THIS GO TO THE THE CORECT PROFILE-->

                                        <img style="margin-right: 10px;" class="avatar" src="<?php 
                                                                                            // Get user info and find either jpg or png profile picture
                                                                                            $userID = $userInfo['userID'];
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
                                            
                                            
                                            <a href="profile.php" > <?php echo $userInfo['username']; ?> </a> <!-- Username -->                                                                                                                           
                                        </div>
                                    </td>

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
                    </table>
                </div>
            </div>
        </main>
        <!-- Footer -->
        <?php include("footer.html"); ?>
    </body>
</html>