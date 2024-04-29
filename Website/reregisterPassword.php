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

if ($_SERVER['REQUEST_METHOD'] == "POST") {
//something was posted

// store post data in a variable (this is so we can remove optional fields later as we can't remove from $_POST)
$postData = $_POST;

// Check if all fields are filled
if (count($postData) == count(array_filter($postData))) {
    # Token and email entered in forms by user.
    $token = $_POST['token'];
    $email = $postData['email'];
    
    # userID extracted from user table by email.
    $userID = $Login_Controller->get_userid_email($email);   

    # Token extracted from recovery table.
    $registeredToken = $Login_Controller->get_token($userID);


    $password1 = $postData['password1'];
    $password2 = $postData['password2'];


    if ($token == $registeredToken) {

        // Check if the passwords match
        if ($password1 == $password2) {

            // Password encryption implementation, usign password hash, by assigning Password_default as the algo, the latest best algorithm for encryption will be picked, even if updated.
            $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

            # New implementation using the new login and database classes.
            $deleteToken = $Login_Controller->delete_recovery_record($userID);
            $updatepassword = $Login_Controller->update_user_password($hashed_password,$userID);
           
            header("Location: login.php");
            die;
        } else {
            $error = "<span style='color: red;'>Passwords do not match</span><br><br>";
        }
    }else{
        $error = "<span style='color: red;'>Incorrect Token</span><br><br>";
    }
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
        <?php include("header.html"); ?>

        <!-- Main -->
        <main>
            <h1>This is the password registry page</h1><br>

            <div class="form">
                <!-- Login Form -->
                <h2>Register Password:</h2>
                <form action="reregisterPassword.php" method="post">

                    Enter your email:<br>
                    <input type="text" name="email" required>
                    <br><br>

                    Enter your password recovery token:<br>
                    <input type="text" name="token" required>
                    <br><br>

                    New password:<br>
                    <input type="password" name="password1" required>
                    <br><br>

                    Confirm Password:<br>
                    <input type="password" name="password2" required>
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



