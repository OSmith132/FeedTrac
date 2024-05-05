<?php

session_start();

include ("classes/Database.class.php");
include ("classes/login.class.php");
include ("classes/LoginContr.class.php");
include ("classes/Feedback.class.php");
include ("classes/FeedbackContr.class.php");
include ("classes/FeedbackView.class.php");
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
$Feedback_View = new FeedbackView($user_data['userID']);


$position = $user_data['position'];

// Show default page if feedbackID is not found in db (This is very lazily made. Sorry about that. - Oliver)
if (!$Feedback_View->get_feedback_exists($feedbackID)){ ?>

        <!-- Header -->
        <?php include("header.php"); ?>

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

        <!-- Main -->
        <main class="feedback-main">

            <h1>Feedback</h1>

            <div class="feedback-header">
                <i>Feedback not found in database.</i>
            </div>

        </main>

        <!-- Footer -->
        <div class="footer-position"><?php include("footer.php"); ?></div>

    <?php 
    exit();
    }

$feedback = $Feedback_Controller->feedback_get($feedbackID);


$text = $feedback["text"];
$user = $user_data['userID'];
$feedback_userID = $feedback["userID"];
$feedback_user_details = $Login_Controller->get_feedback_user_details($feedback_userID);
$feedback_date = $feedback["date"];
$ratingPoints_comment = 0;
$course= $user_data["courseID"];
$users = $Feedback_Controller->list_users($course);
$feedbackUserData = $Feedback_View->get_user_info($feedbackID);;

// Generates text for the closed button
$feedbackClosedLabel = $feedback['closed'];
$feedbackClosedButtonLabel;

if ($feedbackClosedLabel == "0" ){
    $feedbackClosedButtonLabel = "Open";
    
}
else{
    $feedbackClosedButtonLabel = "Closed";
}

// Generates text for the resolved button
$feedbackResolvedLabel = $feedback['resolved'];
$feedbackResolvedButtonLabel;

if ($feedbackResolvedLabel == "0" ){
    $feedbackResolvedButtonLabel = "Unresolved";
    
}
else{
    $feedbackResolvedButtonLabel = "Resolved";
}

// Get comments
$comments = $Feedback_Controller->find_comments($feedbackID);
$comments_count = count($comments);

function achtung($users,$Feedback_Controller,$user_data){
    foreach ($users as $user) {
        if ($user['userID'] !== $user_data["userID"] && $user['sub'] == "1"){
       // echo $user['userID'] . "\n";
        $Feedback_Controller->sub_alert($user['userID']);
        }
    }   


}


if (isset($_POST['submit_comment'])) {
    $comment_text = $_POST['comment_text'];
    $Feedback_Controller->new_comment($user, $feedbackID, $comment_text, $ratingPoints_comment);
    date_default_timezone_set('Europe/London');
    $newDate = date_create();
    $Feedback_Controller->modify_date($feedbackID,$newDate);

    achtung($users,$Feedback_Controller,$user_data);  
    header("Location: " . $_SERVER['REQUEST_URI']); 
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

            <form method="POST" action="">
                <button type="submit" name="openButton"><?= htmlspecialchars($feedbackClosedButtonLabel, ENT_QUOTES, 'UTF-8'); ?></button>
            </form>

            <!-- User can only set to resolved if they created the feedback item, or are a system admin -->
            <?php if ($_SESSION['userID'] == $feedbackUserData['userID'] || $position == "admin") {?>
                <form method="POST" action=""> <?php } ?>
                    <button type="submit" name="resolvedButton"><?= htmlspecialchars($feedbackResolvedButtonLabel, ENT_QUOTES, 'UTF-8'); ?></button>
                </form>
           
            
            <?php
            if (isset($_POST['openButton'])) {
                if ($feedbackClosedLabel == "0" && $position !== "student"){
                    $feedbackStatus = $feedback['closed'];
                    $feedbackstatus = 1;
                    $Feedback_Controller->set_feedback_status($feedbackID,$feedbackstatus);
                    achtung($users,$Feedback_Controller,$user_data);
                    header("Location: " . $_SERVER['REQUEST_URI']);
                    exit();
                    
                }
                elseif($feedbackClosedLabel == "1" && $position !== "student"){
                    $feedbackStatus = $feedback['closed'];
                    $feedbackstatus = 0;
                    $Feedback_Controller->set_feedback_status($feedbackID,$feedbackstatus);
                    achtung($users,$Feedback_Controller,$user_data);
                    header("Location: " . $_SERVER['REQUEST_URI']);
                    exit();
                }               
            }

            if (isset($_POST['resolvedButton'])) {
                if ($feedbackResolvedLabel == "0" && ($position !== "student" || $_SESSION['userID'] == $feedbackUserData['userID']) ){
                    $feedbackResolved = $feedback['resolved'];
                    $feedbackresolved = 1;
                    $Feedback_Controller->set_feedback_resolved($feedbackID,$feedbackresolved);
                    achtung($users,$Feedback_Controller,$user_data);
                    header("Location: " . $_SERVER['REQUEST_URI']);
                    exit();
                    
                }
                elseif($feedbackResolvedLabel == "1" && ($position !== "student" || $_SESSION['userID'] == $feedbackUserData['userID']) ){
                    $feedbackResolved = $feedback['resolved'];
                    $feedbackresolved = 0;
                    $Feedback_Controller->set_feedback_resolved($feedbackID,$feedbackresolved);
                    achtung($users,$Feedback_Controller,$user_data);
                    header("Location: " . $_SERVER['REQUEST_URI']);
                    exit();
                }               
            }
            
            ?>


                
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
                }?>"alt="User Avatar" height="32"><a href="profile.php"> <?= htmlspecialchars($feedback_user_details["username"], ENT_QUOTES, 'UTF-8'); ?> </a> raised this feedback on <?= htmlspecialchars($feedback["date"], ENT_QUOTES, 'UTF-8'); ?> · <?= htmlspecialchars($comments_count, ENT_QUOTES, 'UTF-8'); ?> comments.</p>
                 
                <!-- Heart Button -->
                <button id="heart-toggle" title="Like" onclick="like()">
                    <i id="heart-symbol" class="fa-regular fa-heart"></i> <div style="display:inline-block;" id=heart-counter><?= htmlspecialchars($feedback["ratingPoints"], ENT_QUOTES, 'UTF-8'); ?></div>
                </button>
            </div>
                <?php
            

            if ($feedbackClosedLabel == "0") {
            ?>
                <!-- Comment Form -->
                <form method="POST" action="">
                    <div style="display: flex; align-items: center;">
                        <textarea class="feedback-comment" name="comment_text" required style="width: 800px; height: 35px;" placeholder="Add Comment..."></textarea>
                        <button class="feedback-button" type="submit" name="submit_comment">Submit</button>
                    </div>
                </form>
                <?php

            } else { ?>


                <div class="feedback-closed">
                    <strong><i>This feedback is closed and no longer accepting comments.</i></strong>
                </div>
                
            <?php        
            }
            ?>

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



        </main> 

        <!-- Footer -->
        <div class="footer-position"><?php include("footer.php"); ?></div>
    </body>
    
</html>
