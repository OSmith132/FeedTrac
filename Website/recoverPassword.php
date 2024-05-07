<?php
session_start();

include ("classes/Database.class.php");
include ("classes/login.class.php");
include ("classes/LoginContr.class.php");
include ("classes/Feedback.class.php");
include ("classes/FeedbackContr.class.php");
include ("scripts/functions.php");

$Login_Controller = new LoginContr();

// Checks user isn't logged in
$Login_Controller->check_login();

$error = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){
	// Something was posted
	$email = $_POST['email'];


	if(!empty($email)){

        // Gets the recovery code
        $recovery_code = $Login_Controller->create_recovery_token($email);

        // Checks if the user exists
        if($recovery_code != -1) {           

            $Login_Controller->send_recovery_email($email); // Calls method that sends recovery email, currently disabled and echoes token above header for testing purposes.

            $_SESSION['recovery_email_sent'] = true; // Checks if it has been sent.

        } else {
            $error = "<span style='color: red;'>No user with this email address found</span><br><br>";
        }
    } else {
        $error = "<span style='color: red;'>Please enter a valid email address</span><br><br>";
    }
}

?>


<!DOCTYPE html>
<html lang="en-gb">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Recover Password - FeedTrac</title>

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
            <h1>This is the password recovery page</h1><br>

            <div class="form">
                <a href="login.php">Log In</a>

                <!-- Login Form -->
                <h2>Recover Password:</h2>
                <form action="recoverPassword.php" method="post"> 

                    Enter registered email address:<br><br>
                    <input type="text" name="email" required>
                    <br><br>

                    <div><?php echo $error ?></div>

                    <input type="submit" value="Send a token.">
                </form>

                <!-- Redirects to reregister page if a token was confirmed to be received by user. -->
                <a href="reregisterPassword.php" class="button">Click here if you have received a token.</a> 

                
                
            </div>

            
        </main>

        <!-- Footer -->
        <?php include("footer.php"); ?>
    </body>
</html>
