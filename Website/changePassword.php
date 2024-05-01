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

$message = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $password1 = $_POST['password1'];

    $password2 = $_POST['password2'];

    if ($password1 == $password2) {

        $userID = $Login_Controller->get_current_user_username();
        $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
        $updatepassword = $Login_Controller->update_user_password($hashed_password,$userID);
       
        $message = "<span style='color: green;'>Password changed</span><br><br>";
    } else {
        $message = "<span style='color: red;'>Passwords do not match</span><br><br>";
    }
}

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
        <?php include("header.php"); ?>

        <!-- Main -->
        <main>
            <h1>Change Password</h1>
            <hr>
            <br>
            <div class="form">

                <!-- Login Form -->
                <h2>Change Password:</h2>
                <form action="changePassword.php" method="post">

                    Enter new password:
                    <input type="password" name="password1" id="password1" required>

                    <label style="display: inline-block; font-weight: normal;">
                        <input type="checkbox" onclick="togglePasswordVisibility('password1')"> Show Characters<br>
                    </label>
                    <br>

                    Confirm new password:
                    <input type="password" name="password2" id="password2" required>

                    <label style="display: inline-block; font-weight: normal;">
                        <input type="checkbox" onclick="togglePasswordVisibility('password2')"> Show Characters<br>
                    </label>
                    <div><?php echo $message ?></div>
                    <br>

                    <input type="submit" value="Submit">
                </form>
            </div>
        </main>

        <!-- Footer -->
        <div class="footer-position"><?php include("footer.php"); ?></div>
    </body>
</html>