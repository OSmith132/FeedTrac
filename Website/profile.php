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



if($_SERVER['REQUEST_METHOD'] == "POST"){
    $target_dir = "assets/profile-pictures/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Use the ID for the filename
    $target_file = $target_dir . "user-" . $user_data['userID'] . '.' . $imageFileType;

// Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        }
        else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    }
    else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}





?>
<!DOCTYPE html>
<html lang="en-gb">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo $Login_Controller->get_current_user_username();?> - FeedTrac</title>

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
            <h1><?php echo $Login_Controller->get_current_user_username();?></h1>

            <div class="profile-content">
                <div class="user-picture">
                    <h3>Profile Picture:</h3>
                    <img class="avatar" src="<?php
                    // Get user info and find either jpg or png profile picture
                    $userID = $_SESSION['userID'];
                    $jpg_path = "assets/profile-pictures/user-$userID.jpg";
                    $png_path = "assets/profile-pictures/user-$userID.png";

                    // Return
                    if (file_exists($jpg_path)) {
                        echo $jpg_path;
                    } elseif (file_exists($png_path)) {
                        echo $png_path;
                    } else {
                        echo "assets/profile-pictures/user-default.jpg";
                    }?>" alt="User Avatar" height="200">
                </div>

                <div class="user-description">
                    <h3>About:</h3>
                    <!-- TODO: Implement this in the database -->
                    <p>[User table currently doesn't support a user description or "about me"]</p>
                </div>

                <div class="user-data">
                    <h3>Personal Information:</h3>
                    <ul>
                        <li>Email: <?php echo $Login_Controller->get_current_user_email();?></li>
                        <li>Username: <?php echo $Login_Controller->get_current_user_username();?></li>
                        <li>First Name: <?php echo $Login_Controller->get_current_user_first_name();?></li>
                        <li>Last Name: <?php echo $Login_Controller->get_current_user_last_name();?></li>
                        <li>Year of Study: <?php echo $Login_Controller->get_current_user_study_year();?></li>
                        <li>Pronouns: <?php echo $Login_Controller->get_current_user_pronouns();?></li>
                        <li>Position: <?php echo $Login_Controller->get_current_user_position();?></li>
                    </ul>
                </div>
            </div>

            <div class="edit-profile">
                <div class="change-picture">
                    <form action="profile.php" method="post" enctype="multipart/form-data" class="upload-form">
                        <label for="profile-picture">Upload a profile picture:</label><br>
                        <input type="file" accept="image/png"  name="fileToUpload" id="fileToUpload"><br>
                        <input type="submit" value="Upload" class="profile-button">
                    </form>
                </div>

                <div class="edit-description">
                    <button class="profile-button">Edit About Section</button>
                </div>

                <div class="edit-data">
                    <button class="profile-button">Edit Personal Information</button>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <?php include("footer.html");?>
    </body>
</html>
