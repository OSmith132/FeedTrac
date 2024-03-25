<?php
session_start();

include("classes/Database.class.php");
include("scripts/functions.php");

Database::connect();

// Check user isn't logged in
Database::force_logout();



if ($_SERVER['REQUEST_METHOD'] == "POST") {
//something was posted

// store post data in a variable (this is so we can remove optional fields later as we can't remove from $_POST)
$postData = $_POST;

// Check if all fields are filled
if (count($postData) == count(array_filter($postData))) {
    $token = $_POST['token'];
    $email = $postData['email'];

    $result = Database::query("SELECT userID FROM user WHERE email = '$email' LIMIT 1");
    $row = mysqli_fetch_assoc($result);
    $userID = $row['userID'];

    $result = Database::query("SELECT token FROM recovery WHERE userRecoveryID = '$userID' LIMIT 1");
    $row = mysqli_fetch_assoc($result);
    $registeredToken = $row['token'];
    $registeredToken = strval($registeredToken);

    $password1 = $postData['password1'];
    $password2 = $postData['password2'];


    if ($token == $registeredToken) {

        // Check if the passwords match
        if ($password1 == $password2) {

            //save to database (userID is an auto-incrementing integer, so we don't need to specify it in the query)
            // Password encryption implementation, usign password hash, by assigning Password_default as the algo, the latest best algorithm for encryption will be picked, even if updated.
            $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
            echo "We did it.";
            // change query to input correct course id
            Database::query("UPDATE user SET passwordHash = '$hashed_password' WHERE userID = $userID");
            Database::query("DELETE FROM recovery WHERE userRecoveryID = $userID");

            header("Location: login.php");
            die;
        } else {
            echo "Passwords do not match";
        }
    }else{
        echo "Token is not correct. Try again.";
    }
}



}

?>


<!DOCTYPE html>
<html>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<body>

		<!-- Title -->
		<head>
			<title>FeedTrac</title>
		</head>

		<!-- Header -->
		<h1>This is the password registry page</h1>
        <a href="signup.php">Sign Up</a>


        <!-- Login Form -->
        <h2>Register Password:</h2>
        <form action="reregister_password.php" method="post">

            Enter your email:<br>
            <input type="text" name="email" >
            <br>

            Enter your password recovery token:<br>
            <input type="text" name="token">
            <br>

            New password:<br>
            <input type="password" name="password1">
            <br>

            Confirm Password:<br>
            <input type="password" name="password2">
            <br>


            <input type="submit" value="Submit">
        </form><br><br>





        <!-- Change Dark/Light Modes -->

		<style>
			body {
				padding: 15px;
				background-color: #353535;
				color: white;
				font-size: 15px;
			}

			.dark-mode {
				background-color: #353535;
				color: white;
			}

			.light-mode {
				background-color: white;
				color: black;
			}
		</style>

        <h3 id="DarkModetext">Dark Mode is ON</h3>
        <button onclick="darkMode()">Dark Mode</button>
        <button onclick="lightMode()">Light Mode</button>

        <script>
            function darkMode() {
                let element = document.body;
                let content = document.getElementById("DarkModetext");
                element.className = "dark-mode";
                content.innerText = "Dark Mode is ON";
            }
            function lightMode() {
                let element = document.body;
                let content = document.getElementById("DarkModetext");
                element.className = "light-mode";
                content.innerText = "Dark Mode is OFF";
            }
        </script>


    </body>
</html>



