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


//!---TODO Add extra checks for image upload like size etc.
//!---TODO need to overwrite images if they already exist.
if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['Upload'])){
        switch ($_POST['Upload']) {
            case 'Picture':
                $target_dir = "assets/profile-pictures/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Use the ID for the filename
                $target_file = $target_dir . "user-" . $user_data['userID'] . '.' . $imageFileType;

                // Check if image file is an actual image or fake image
                if (isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if ($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
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
                        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
                break;
            case 'Description':
                // Upload flag
                $uploadOk = 1;
                $new_text = $_POST['Description_Text'];
                //echo $new_text;
                if(sizeof($new_text) > 255) {
                  $uploadOk = 0;
                  echo "Text input is too long please restrict to 255 characters or less.";
                }



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
        <div>
            <h1><?php echo $Login_Controller->get_current_user_username();?></h1>
            <!-- Content -->
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

                    <p contenteditable="false" id="description_text_box"><?php
                        $bio = $Login_Controller->get_current_user_description();
                        if (empty($bio)){
                            echo "Add some details about yourself..";
                        }
                        else {
                            echo $bio;
                        }
                    ?></p>
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

            <!-- Buttons -->
            <div class="edit-profile">
                <div class="change-picture">
                    <form action="profile.php" method="post" enctype="multipart/form-data" class="upload-form">
                        <label for="profile-picture">Upload a profile picture:</label><br>
                        <input type="file" accept="image/png"  name="fileToUpload" id="fileToUpload"><br>
                        <input type="submit" name="Upload" value="Picture" class="profile-button">
                    </form>
                </div>

                <div class="edit-description">
                    <button class="profile-button" id="description_edit_button" onclick="edit_description()">Edit About Section</button>
                    <button class="profile-button" id="description_save_button" hidden="hidden" onclick="save_description()">Accept</button>

                    <!-- Input box hidden to allow content box to look nice -->
                    <form action="profile.php" method="post" enctype="multipart/form-data" hidden="hidden">
                        <input type="text" name="Description_Text" id="upload_description_text_box">
                        <input type="submit" name="Upload" value="Description" id="upload_description_submit">
                    </form>

                    <script>
                        function edit_description() {
                            // Allow users to enter info into the box
                            document.getElementById("description_text_box").contentEditable = "true";
                            // Switch button visibility
                            document.getElementById("description_edit_button").hidden =true;
                            document.getElementById("description_save_button").hidden = false;
                        }
                        function save_description() {
                            // Prevent users changing the info in the box
                            document.getElementById("description_text_box").contentEditable = "false";
                            // Switch button visibility
                            document.getElementById("description_edit_button").hidden = false;
                            document.getElementById("description_save_button").hidden = true;
                            // Add data and press submit button
                            document.getElementById("upload_description_text_box").value = document.getElementById("description_text_box").innerText;
                            document.getElementById("upload_description_submit").click();
                        }
                    </script>
                </div>

                <div class="edit-data">
                    <button class="profile-button">Edit Personal Information</button>
                </div>
            </div>

        </div>
        </main>

        <!-- Footer -->
        <div class="footer-position"><?php include("footer.php"); ?></div>
    </body>
</html>
