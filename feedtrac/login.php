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



if($_SERVER['REQUEST_METHOD'] == "POST"){
	//something was posted
	$username = $_POST['username'];
	$password = $_POST['password'];
    
    
	if(!empty($username) && !empty($password)){
        
        // Check if the user exists
        if($Login_Controller->user_exists($username)){

            // Verify the password
            if($Login_Controller->check_password($username, $password)) {
                
                $_SESSION['userID'] = $Login_Controller->get_userid($username);  // change this so it assigns the correct userID

                header("Location: index.php");
                die;
            } else {
                echo "Incorrect password";
            }
        } else {
            echo "No User Found In Database";
        }
    } else {
        echo "Please enter a valid username and password";
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
		<h1>This is the login page</h1>
        <a href="signup.php">Sign Up</a>

        <!-- Login Form -->
        <h2>Login:</h2>
        <form action="login.php" method="post">
        
            Username:<br>
            <input type="text" name="username">
            <br>
            
            Password:<br>
            <input type="password" name="password">
            <br><br>
            
            <input type="submit" value="Login">
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



        