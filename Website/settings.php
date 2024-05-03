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

$error = "";



if($_SERVER['REQUEST_METHOD'] == "POST"){

    $password = $_POST['password'];

    if(!empty($password)){

        //Get username
        $username = $Login_Controller->get_current_user_username();

        if($Login_Controller->check_password($username, $password)) {

            $Login_Controller->delete_account();

            header("Location: accountDeleted.php");
            die;
        }
        else {
            $error = "<br><br><span style='color: red;'>Please enter the correct password to delete your account</span><br><br>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en-gb">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Settings - FeedTrac</title>

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
            <h1>Settings</h1>
            <hr>
            <br>
            <div class="settings-container">
                <div class="settings">
                    <button id="recoverButton" class="feedback-button" onclick="window.location.href = 'changePassword.php'" >Change Password</button>
                    <br><br>
                    <button id="editButton" class="feedback-button" onclick="window.location.href = 'changeDetails.php'">Edit Personal Details</button>
                    <br><br>
                    <button id="deleteButton" class="feedback-button" onclick="openForm('deletion-form')" >Delete Account</button>
                    <div><?php echo $error ?></div>
                </div>

                <form action="settings.php" id="deletion-form" class="popup-form" method="post">
                    <label>Enter your password to confirm account deletion:</label><br><br>

                    <label>Password:</label>
                    <input type="password" name="password" id="password" placeholder="Enter Password" required><br><br>

                    <label style="display: inline-block; font-weight: normal;">
                        <input type="checkbox" onclick="togglePasswordVisibility('password')"> Show Characters<br>
                    </label><br><br>

                    <label style="color:red;">Warning: This action cannot be undone</label><br><br>

                    <button type="submit">Delete Account</button>
                    <button type="button" onclick="closeForm('deletion-form')">Close</button>
                </form>
            </div>

        </main>

        <!-- Footer -->
        <div class="footer-position"><?php include("footer.php"); ?></div>
    </body>
</html>