<?php
session_start();

include("connection.php");
include("functions.php");

// Check user isn't logged in
force_logout($con);

if($_SERVER['REQUEST_METHOD'] == "POST"){
	//something was posted
	$username = $_POST['username'];
	$password = $_POST['password'];

	if(!empty($username) && !empty($password)){

		// Check that username and password match db
		$query = "SELECT * FROM user WHERE username = '$username' /*AND passwordHash = '$password'*/ LIMIT 1";
		$result = mysqli_query($con, $query);

        if($result)
        {
            
            if(mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                
                // Check that the password matches the hashed password in the db ---------------------------------------
                if(/*$user_data['passwordHash'] === $password*/ true ) // remove the or true when we have hashed passwords
                {
                    $_SESSION['userID'] = $user_data['userID'];
                    header("Location: index.php");
                    die;
                }
                
            }
        }

		echo "Please enter a valid username and password";
	}else{
		echo "No User Found In Database";
	}
}
?>


<!DOCTYPE html>
<html>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="login.css">
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
            <input type="text" name="password">
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



        