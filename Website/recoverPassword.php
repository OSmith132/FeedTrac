<?php
session_start();

include ("classes/Database.class.php");
include ("classes/login.class.php");
include ("classes/LoginContr.class.php");
include ("classes/Feedback.class.php");
include ("classes/FeedbackContr.class.php");
include ("scripts/functions.php");

$Login_Controller = new LoginContr();

// Check user isn't logged in
$Login_Controller->check_login();

$error = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){
	//something was posted
	$email = $_POST['email'];


	if(!empty($email)){

        // Get the recovery code
        $recovery_code = $Login_Controller->create_recovery_token($email);

        // Check if the user exists
        if($recovery_code != -1) {           

            $Login_Controller->send_recovery_email($email);

            header("Location: reregisterPassword.php");

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

                    <input type="submit" value="Submit">
                </form>
            </div>
        </main>

        <!-- Footer -->
        <?php include("footer.html"); ?>
    </body>
</html>



