<?php
session_start();

// Need to add autoloader for this but can't be bothered right now ================================
include ("classes/Database.class.php");
include ("classes/login.class.php");
include ("classes/LoginContr.class.php");
include ("classes/Feedback.class.php");
include ("classes/FeedbackContr.class.php");
include ("scripts/functions.php");

$Login_Controller = new LoginContr();

// Check user isn't logged in
$Login_Controller->check_login();

$logged_in = isset($_SESSION["userID"]);
if ($logged_in) {
header("Location: index.php");
exit;
}


$error = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    // Something was posted
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if(!empty($username) && !empty($password)){
        
        // Check if the user exists and that the account is active
        // Todo: Reimplement "&& $Login_Controller->is_active($username) === 1"
        if($Login_Controller->user_exists($username)){

            // Verify the password
            if($Login_Controller->check_password($username, $password)) {
                
                $_SESSION['userID'] = $Login_Controller->get_userid($username);  // change this so it assigns the correct userID

                header("Location: index.php");
                die;
            }
            else {
                $error = "<span style='color: red;'>Incorrect password</span><br><br>";
            }
        } 
        else {
            $error = "<span style='color: red;'>No active user found in database</span><br><br>";
        }
    }
    else {
        $error = "<span style='color: red;'>Please enter a valid username and password</span><br><br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en-gb">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Login - FeedTrac</title>

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
            <h1>Log in to your FeedTrac account</h1><br>

            <div class="form">
                <a href="signup.php">New to FeedTrac? Sign-up here instead.</a>
                <h2>Login:</h2>
                <!-- Login Form -->
                <form action="login.php" method="post">
                
                    Username:<br>
                    <input type="text" name="username" required>
                    <br>
                    
                    Password:
                    <input type="password" name="password" id="password" required>
                    <label style="display: inline-block; font-weight: normal;">
                        <input type="checkbox" onclick="togglePasswordVisibility('password')"> Show Characters<br>
                    </label><br>

                    <div><?php echo $error ?></div>

                    <a href="recoverPassword.php">Forgot password?</a>
                    <br><br>
                    
                    <input type="submit" value="Login">
                </form>
            </div>
        </main>

        <!-- Footer -->
        <?php include("footer.php"); ?>
    </body>
</html>
