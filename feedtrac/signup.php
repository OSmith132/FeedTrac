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

		$email = $postData['email'];
		$username = $postData['username'];
		$password1 = $postData['password1'];
		$password2 = $postData['password2'];
		$fname = $postData['fname'];
		$lname = $postData['lname'];
		$courseID = $postData['course'];
		$yearOfStudy = $postData['yearOfStudy'];
		$pronouns = $postData['pronouns'];
		$position = $postData['position'];



		// Check if the username or email is already taken
		if (!$Login_Controller->exists_username_email($username, $email)) {

			// Check if the passwords match
			if ($password1 == $password2) {

				//save to database (userID is an auto-incrementing integer, so we don't need to specify it in the query)
				// Password encryption implementation, usign password hash, by assigning Password_default as the algo, the latest best algorithm for encryption will be picked, even if updated.
				$hashed_password = password_hash($password1, PASSWORD_DEFAULT);
				// change query to input correct course id
				$Login_Controller->sign_up($email, $username, $hashed_password, $fname, $lname, $courseID, $yearOfStudy, $pronouns, $position);

				header("Location: login.php");
				die;
			}
			else
			{
				$error = "<span style='color: red;'>Passwords do not match</span><br><br>";
			}
		}
		else
		{
			$error = "<span style='color: red;'>Username or email already taken</span><br><br>";
		}
	}
	else 
	{
		$error = "<span style='color: red;'>Please enter a valid username and password</span><br><br>";
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
			<h1>This is the Sign-Up page</h1><br>

			<div class="form">
				<a href="login.php">Log In</a>

				<!-- Sign-Up Form -->
				<h2>Sign Up:</h2>
				<form action="signup.php" method="post">
				
					Email:<br>
					<input type="text" name="email" required>
					<br><br>
					
					Username:<br>
					<input type="text" name="username" required>
					<br><br>
					
					Password:<br>
					<input type="password" name="password1" required>
					<br><br>

					Confirm Password:<br>
					<input type="password" name="password2" required>
					<br><br>
				
					First Name:<br>
					<input type="text" name="fname" required>
					<br><br>
				
					Last Name:<br>
					<input type="text" name="lname" required>
					<br><br>


					

					<!-- Maybe add reading avalable courses from the DB -->
					<select name="course">
						<option selected disabled hidden>Select Course</option>

						<?php 
							// Get all courses from the database
							$courses = $Login_Controller->get_courses();
							
							// Get each course
							foreach ($courses as $course) {?>

								<option value= <?php echo $course["courseID"] ?> > <?php echo $course["name"] ?></option> 

							<?php } ?>
						
						

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

					<div><?php echo $error ?></div>

					<input type="submit" value="Sign Up">
				</form>
			</div>
		</main>

        <!-- Footer -->
        <?php include("footer.html"); ?>

    </body>
</html>