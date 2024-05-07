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
} else {
    $feedbackID = 0;                           // WHEN ID = 0 IT WILL NEED TO SHOW A DEFAULT PAGE
}

$Feedback_Controller = new FeedbackContr($user_data['userID']);
$Feedback_View = new FeedbackView($user_data['userID']);

$position = $user_data['position']; // Gets position of currently logged in user to check if it can use moderation tools.

// Show feedback 404 page if feedbackID is not found in db
if (!$Feedback_View->get_feedback_exists($feedbackID)) {
    header("location: feedback404.php");
    exit();
}

$feedback = $Feedback_Controller->feedback_get($feedbackID); // Get's feedback item as an array.

//Gets all variables needed using keys.
$title = $feedback["title"];
$text = $feedback["text"];
$user = $user_data['userID'];
$feedback_userID = $feedback["userID"];
$feedback_user_details = $Login_Controller->get_feedback_user_details($feedback_userID);
$feedback_date = $feedback["date"];
$ratingPoints_comment = 0;
$course= $user_data["courseID"];
$users = $Feedback_Controller->list_users($course);
$hasRated = $Feedback_Controller->check_user_has_feedback_rating($feedbackID, $user); // Checks if user has rated this item to prevent repeated votes.
$feedbackUserData = $Feedback_View->get_user_info($feedbackID);

// Generates text for the closed button depending on status in database.
$feedbackClosedLabel = $feedback['closed'];
$feedbackClosedButtonLabel; // Label for displaying status in tag

// Checks for status and applies correct label to moderation button to open/close
if ($feedbackClosedLabel == "0" ) {
    $feedbackClosedButtonLabel = "Close Feedback";
} else {
    $feedbackClosedButtonLabel = "Reopen Feedback";
}

// Generates text for the resolved button same as open/close button above
$feedbackResolvedLabel = $feedback['resolved'];
$feedbackResolvedButtonLabel;

if ($feedbackResolvedLabel == "0" ) {
    $feedbackResolvedButtonLabel = "Mark as Resolved";
} else {
    $feedbackResolvedButtonLabel = "Mark as Unresolved";
}

// Gets comments
$comments = $Feedback_Controller->find_comments($feedbackID);
$comments_count = count($comments); // Counts comments to display in feeback item.

// small local function to call the alert when a new comment or any action is taken involving the feedback item only alerts subbed users.
function achtung($users,$Feedback_Controller,$user_data){ 
    foreach ($users as $user) {
        if ($user['userID'] !== $user_data["userID"] && $user['sub'] == "1") {
            $Feedback_Controller->sub_alert($user['userID']);
        }
    }   
}

if (isset($_POST['submit_comment'])) { // Check to submit comments if a comment hs been posted.
    $comment_text = $_POST['comment_text'];

    $Feedback_Controller->new_comment($user, $feedbackID, $comment_text, $ratingPoints_comment); // New comment saved in database.
    date_default_timezone_set('Europe/London'); // Sets date for correct timezone, to date comments and feedback items.
    $newDate = date_create();
    $Feedback_Controller->modify_date($feedbackID,$newDate); // Changes date of last update to feedback item.
    achtung($users,$Feedback_Controller,$user_data);  // Calls alerts again.
    header("Location: " . $_SERVER['REQUEST_URI']);  // Refreshes page and ends scripts to show updates.
    exit();
}


// Same logic as open or closed button, checks for status to toggle rating vote.
if(isset($_POST['like'])){
    echo "like pushed";
    echo "feedback id = " . $feedbackID;
    echo "user id = " . $user;
    if ($Feedback_Controller->check_user_has_feedback_rating($feedbackID,$user)) {
        $Feedback_Controller->remove_user_feedback_rating($feedbackID, $user);
        echo "user has feedback";
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
    else {
        //$controller->set_rating(1,$feedback_ID,$user_ID);
        $Feedback_Controller->add_user_feedback_rating($feedbackID,$user);
        echo "user has no feedback";
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en-gb">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title of the feedback, fetching title from database. -->
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?> - FeedTrac</title>

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
        <div class="feedback-toolbar">
            <div class="feedback-toolbar-box">
                <?php echo ($feedbackClosedLabel == 0) ? ("
                <p class='tag tag-open'>Open</p>") : ("<p class='tag tag-closed'>Closed</p>"); ?>
                <?php echo ($feedbackResolvedLabel == 0) ? ("
                <p class='tag tag-unresolved'>Unresolved</p>") : ("<p class='tag tag-resolved'>Resolved</p>"); ?>
            </div>

            <div class="feedback-toolbar-box">
                <!-- BEHAVIOUR (BUTTON REQUIREMENTS) -->
                <!-- Open/Close - Any non-student -->
                <!-- Resolve - Feedback author or admin -->
                <!-- Delete - Feedback author or any non-student -->

                <!-- OPEN/CLOSE BUTTON -->
                <form method="POST" action="">
                    <button class="accent-button" type="submit" name="openButton" <?php if ($position == "student") echo "hidden=''" ?>><?= htmlspecialchars($feedbackClosedButtonLabel, ENT_QUOTES, 'UTF-8'); ?></button>
                </form>

                <!-- RESOLVE BUTTON -->
                <!-- User can only set to resolved if they created the feedback item, or are a system admin -->
                <?php if ($_SESSION['userID'] == $feedbackUserData['userID'] || $position == "admin") {?>
                <form method="POST" action=""><?php } ?>
                    <button class="accent-button" type="submit" name="resolvedButton" <?php if ($_SESSION["userID"] != $feedbackUserData["userID"] && $position != "admin") echo "hidden=''" ?>><?= htmlspecialchars($feedbackResolvedButtonLabel, ENT_QUOTES, 'UTF-8'); ?></button>
                </form>

                <!-- Open/close BUTTON same logic as above. -->
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
                
                // Same logic again, reusing as much code as possible.
                if (isset($_POST['resolvedButton'])) {
                    if ($feedbackResolvedLabel == "0" && ($_SESSION['userID'] == $feedbackUserData['userID'] || $position == "admin")){
                        $feedbackResolved = $feedback['resolved'];
                        $feedbackresolved = 1;
                        $Feedback_Controller->set_feedback_resolved($feedbackID,$feedbackresolved);
                        achtung($users,$Feedback_Controller,$user_data);
                        header("Location: " . $_SERVER['REQUEST_URI']);
                        exit();

                    }
                    elseif($feedbackResolvedLabel == "1" && ($_SESSION['userID'] == $feedbackUserData['userID'] || $position == "admin")){
                        $feedbackResolved = $feedback['resolved'];
                        $feedbackresolved = 0;
                        $Feedback_Controller->set_feedback_resolved($feedbackID,$feedbackresolved);
                        achtung($users,$Feedback_Controller,$user_data);
                        header("Location: " . $_SERVER['REQUEST_URI']);
                        exit();
                    }

                }

                // Post from delete feedback button, removes feedback but first deletes comments, my solution for not being able to cascade deletes in myphpadmin.
                if (isset($_POST['deleteFeedback'])) {
                    if ($_SESSION['userID'] == $feedbackUserData['userID'] || $position !== "student"){

                        $Feedback_Controller->remove_feedback($feedbackID);
                        header("Location: " . $_SERVER['REQUEST_URI']);
                        exit();

                    }
                }
                // Same method as above, only tweaked to work for comments, uses hidden comment variables to be able to cross check with current user logged to enforce privilege rules.
                if (isset($_POST['deleteComment'])) {

                    if ($_SESSION['userID'] == $_POST['commentUserID'] || $position !== "student"){
                        $Feedback_Controller->remove_comment($_POST['commentID']);
                        echo $_POST['commentID'];
                        echo $user_data['userID'];
                        echo $_POST['commentUserID'];
                        header("Location: " . $_SERVER['REQUEST_URI']);
                        exit();
                    }
                }

                ?>

                <!-- DELETE BUTTON -->
                <form method="POST" action="">
                    <button class="accent-button" type="submit" name="deleteFeedback" <?php if ($_SESSION["userID"] != $feedbackUserData["userID"] && $position == "student") echo "hidden=''" ?>>Delete Feedback</button>
                </form>
            </div>
        </div>

        <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1>
        <h2><?= htmlspecialchars($text, ENT_QUOTES, 'UTF-8'); ?></h2>

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
                    <i id="heart-symbol" class="<?php if($hasRated){echo"fa-solid fa-heart";}else{echo"fa-regular fa-heart";}?>"></i> <div style="display:inline-block;" id=heart-counter><?= htmlspecialchars($feedback["ratingPoints"], ENT_QUOTES, 'UTF-8'); ?></div>
                </button>

                <form method="post" action="" enctype="multipart/form-data">
                <button id="like_post" type="submit" name="like" hidden="hidden">test</button>
                </form>
            </div>


            <?php

                // Checks if feedback is open before offering option to comment.
        if ($feedbackClosedLabel == "0") {
        ?>
            <!-- Comment Form -->
            <form method="POST" action="">
                <div style="display: flex; align-items: center;">
                    <textarea class="feedback-comment" name="comment_text" required style="width: 300px; height: 35px;" placeholder="Add Comment..."></textarea>
                    <button class="accent-button" type="submit" name="submit_comment">Add Comment</button>
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
            
            <?php foreach ($comments as $comment): // Generates comments for each comment found with this feedback id, presents delete buttons.
                $commentUserID = $comment['userID'];
                $commentUserDetails = $Login_Controller->get_feedback_user_details($commentUserID);
                $commentID = $comment['commentID'];

            ?>
                <div class="comment">
                    <div class="comment-header">
                        <p><img class="avatar" src="<?php
                            // Get user info and find either jpg or png profile picture
                            $userID = $_SESSION['userID'];
                            $jpg_path = "assets/profile-pictures/user-$commentUserID.jpg";
                            $png_path = "assets/profile-pictures/user-$commentUserID.png";

                            // Return
                            if (file_exists($jpg_path)) {
                                echo $jpg_path;
                            } elseif (file_exists($png_path)) {
                                echo $png_path;
                            } else {
                                echo "assets/profile-pictures/user-default.jpg";
                            }?>" alt="User Avatar" height="32"><a href="profile.php"> <?= htmlspecialchars($commentUserDetails['username'], ENT_QUOTES, 'UTF-8'); ?></a> commented <?= htmlspecialchars($comment['date'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <form method="POST" action="">
                                <input type="hidden" name="commentID" value="<?= $commentID ?>">
                                <input type="hidden" name="commentUserID" value="<?= $commentUserID ?>">
                                <button class="accent-button" type="submit" name="deleteComment">Delete Comment</button>
                            </form>                
                        </div>
                    <div class="comment-main">
                        <p><?= htmlspecialchars($comment['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>     

        </main> 

    <!-- Footer -->
    <?php include("footer.php"); ?>
</body>
</html>