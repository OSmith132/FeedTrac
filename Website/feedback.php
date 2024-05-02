
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



// Get the feedbackID from the URL
if (isset($_GET['id'])) {
    $feedbackID = $_GET['id'];                 // THIS IS THE ID THAT SHOULD BE READ FROM THE DB -----------
}
else {
    $feedbackID = 0;                           // WHEN ID = 0 IT WILL NEED TO SHOW A DEFAULT PAGE
}

$Feedback_Controller = new FeedbackContr($user_data['userID']);

$feedback = $Feedback_Controller->feedback_get($feedbackID);

$text = $feedback["text"];
// FIXME does this need to be initialised with a value? it has red line underneath
$comment_text;
$user = $user_data['userID'];
$feedback_userID = $feedback["userID"];
$feedback_user_details = $Login_Controller->get_feedback_user_details($feedback_userID);
$feedback_date = $feedback["date"];
$ratingPoints_comment = 0;

$comments = $Feedback_Controller->find_comments($feedbackID);
$comments_count = count($comments);


if (isset($_POST['submit_comment'])) {
    $comment_text = $_POST['comment_text'];
    $Feedback_Controller->new_comment($user, $feedbackID, $comment_text, $ratingPoints_comment);
    header("Location: " . $_SERVER['REQUEST_URI']); // Refresh the page
    exit();
}



?>


<!DOCTYPE html>
<html lang="en-gb">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


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
        <main class="feedback-main">
            <div class="feedback-header">
                <button>Open</button>
                <a href="course.php"><button>Computer Science</button></a>
            </div>

            <h1><?= htmlspecialchars($text, ENT_QUOTES, 'UTF-8'); ?></h1>

            <div class="feedback-header">

            <p><img class="avatar" src="<?php
                // Get user info and find either jpg or png profile picture
                $userID = $_SESSION['userID'];
                $jpg_path = "assets/profile-pictures/user-$feedback_userID.jpg";
                $png_path = "assets/profile-pictures/user-$feedback_userID.png";

                // Return
                if (file_exists($jpg_path)) {
                    echo $jpg_path;
                } elseif (file_exists($png_path)) {
                    echo $png_path;
                } else {
                    echo "assets/profile-pictures/user-default.jpg";
                }?>"alt="User Avatar" height="32"><a href="profile.php"> <?= htmlspecialchars($feedback_user_details["username"], ENT_QUOTES, 'UTF-8'); ?> (26411141)</a> raised this feedback on <?= htmlspecialchars($feedback["date"], ENT_QUOTES, 'UTF-8'); ?> · Comment count  <?= htmlspecialchars($comments_count, ENT_QUOTES, 'UTF-8'); ?></p>
                 
                <!-- Heart Button -->
                <button id="heart-toggle" title="Like" onclick="like()">
                    <i id="heart-symbol" class="fa-regular fa-heart"></i> <div style="display:inline-block;" id=heart-counter><?= htmlspecialchars($feedback["ratingPoints"], ENT_QUOTES, 'UTF-8'); ?></div>
                </button>
            </div>

            <div><hr></div>


            <?php foreach ($comments as $comment): 
                $comment_userID = $comment['userID'];
                $comment_user_details = $Login_Controller->get_feedback_user_details($comment_userID);
            ?>
                <div class="comment">
                    <div class="comment-header">
                        <p><img class="avatar" src="<?php
                            // Get user info and find either jpg or png profile picture
                            $userID = $_SESSION['userID'];
                            $jpg_path = "assets/profile-pictures/user-$comment_userID.jpg";
                            $png_path = "assets/profile-pictures/user-$comment_userID.png";

                            // Return
                            if (file_exists($jpg_path)) {
                                echo $jpg_path;
                            } elseif (file_exists($png_path)) {
                                echo $png_path;
                            } else {
                                echo "assets/profile-pictures/user-default.jpg";
                            }?>" alt="User Avatar" height="32"><a href="profile.php"> <?= htmlspecialchars($comment_user_details['username'], ENT_QUOTES, 'UTF-8'); ?></a> commented <?= htmlspecialchars($comment['date'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                    <div class="comment-main">
                        <p><?= htmlspecialchars($comment['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>


            <div><hr></div>
            

           <!-- Comment Form -->
            <form method="POST" action="">
            
                <textarea class="feedback-comment" name="comment_text" required style="width: 600px; height: 100px;" placeholder="Add Comment..."></textarea>
                <button class="feedback-button" type="submit" name="submit_comment">Submit</button>
            </form>


        </main> 

        <!-- Footer -->
        <div class="footer-position"><?php include("footer.php"); ?></div>
    </body>
</html>
