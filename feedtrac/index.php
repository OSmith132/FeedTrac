
<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
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
		<h1>This is the index page</h1>
		Hello, <?php echo $user_data['username']; ?> <br>
		<a href="logout.php">Logout</a>
		<br><br>

		



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
</hthml>