<?php

session_start();

include("connection.php");
include("functions.php");

// Check user isn't logged in
force_logout($con);

if($_SERVER['REQUEST_METHOD'] == "POST"){
	//something was posted
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$course = $_POST['course'];
	$yearOfStudy = $_POST['yearOfStudy'];
	$pronouns = $_POST['pronouns'];
	$position = $_POST['position'];

	if(!empty($email) && !empty($username) && !empty($password) && !empty($fname) && !empty($lname) && !empty($course) && !empty($yearOfStudy) && !empty($pronouns) && !empty($position)){

		//save to database (userID is an auto-incrementing integer, so we don't need to specify it in the query)
		// We will hash the password before saving it to the database at a later time
		// change query to input correct course id
		$query = "INSERT INTO user (email, username, passwordHash, fname, lname, courseID, yearOfStudy, pronouns, position) VALUES ('$email', '$username', '$password', '$fname', '$lname', 0, '$yearOfStudy', '$pronouns', '$position')";

		mysqli_query($con, $query);

		header("Location: login.php");
		die;
	}else{
		echo "Please enter valid information";
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
		<h1>This is the Sign-Up page</h1>
        <a href="login.php">Log In</a>


        <!-- Sign-Up Form -->
        <h2>Sign Up:</h2>
		<form action="signup.php" method="post">
		
			Email:<br>
			<input type="text" name="email" >
			<br>
			
			Username:<br>
			<input type="text" name="username" >
			<br>
			
			Password:<br>
			<input type="text" name="password">
			<br>
		
			First Name:<br>
			<input type="text" name="fname" >
			<br>
		
			Last Name:<br>
			<input type="text" name="lname" >
			<br><br>

			<!-- Maybe add reading avalable courses from the DB -->
			<select name="course">
				<option selected disabled hidden>Select Course</option>
				<option value="computer science" >Computer Science</option>
				<option value="games computing" >Games Computing (ew)</option>
				<option value="dentistry" >Dentistry</option>
			</select><br><br>

			<select name="yearOfStudy">
				<option selected disabled hidden>Select Year</option>
				<option value="1" >1</option>
				<option value="2" >2</option>
				<option value="3" >3</option>
				<option value="4" >4</option>
			</select><br><br>
			
			<select name="pronouns">
				<option selected disabled hidden>Select Pronouns</option>
				<option value="hehim" >He/Him</option>
				<option value="sheher" >She/Her</option>
				<option value="other" >Other</option>
			</select><br><br>
			
			<select name="position">
				<option selected disabled hidden>Select Position</option>
				<option value="student" >Student</option>
				<option value="staff" >Staff</option>
				<option value="admin" >Admin</option>
			</select><br><br>

			<input type="submit" value="Sign Up">
		</form>
			
			
		<br><br><br>




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