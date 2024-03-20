<?php
session_start();

include("classes/Database.class.php");
include("scripts/functions.php");

Database::connect();

// Check user isn't logged in
Database::force_logout();



if($_SERVER['REQUEST_METHOD'] == "POST"){
	//something was posted
	$email = $_POST['email'];


	if(!empty($email)){
        // Read from the database
        $result = Database::query("SELECT * FROM user WHERE email = '$email' LIMIT 1");

        // Check if the user exists
        if($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            $token =  random_int(100000,999999);

            $userID = $user_data ["userID"];

            $sql = Database::query("INSERT INTO recovery (userRecoveryID, token) VALUES ($userID, $token)");

            $tokenString = strval($token); // Convert token to string

            $to = $user_data['email'];
            $subject = "Feedtrac password recovery";
            $message = "Use this token to register a new password: " . $tokenString; // Concatenate strings
            echo $message;
            $headers = 'From: feedtrac@example.com';
           /* mail($to, $subject, $message, $headers);*/

            header("Location: reregister_password.php");

        } else {
            echo "No user with this email address found.";
        }
    } else {
        echo "Please enter a valid email address";
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
		<h1>This is the password recovery page</h1>
        <a href="signup.php">Sign Up</a>


        <!-- Login Form -->
        <h2>Recover Password:</h2>
        <form action="recover_password.php" method="post">

            Enter registered email address:<br>
            <input type="text" name="email">
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



