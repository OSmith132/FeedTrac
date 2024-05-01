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
		$password = $postData['password'];
		$confirmPassword = $postData['confirmPassword'];
		$firstName = $postData['firstName'];
		$lastName = $postData['lastName'];
		$courseID = $postData['course'];
		$yearOfStudy = $postData['yearOfStudy'];
		$pronouns = $postData['pronouns'];
		$position = $postData['position'];

		// Check if the username or email is already taken
		if (!$Login_Controller->exists_username_email($username, $email)) {

			// Check if the passwords match
			if ($password == $confirmPassword) {

				//save to database (userID is an auto-incrementing integer, so we don't need to specify it in the query)
				// Password encryption implementation, usign password hash, by assigning Password_default as the algo, the latest best algorithm for encryption will be picked, even if updated.
				$hashed_password = password_hash($password, PASSWORD_DEFAULT);
				// change query to input correct course id
				$Login_Controller->sign_up($email, $username, $hashed_password, $firstName, $lastName, $courseID, $yearOfStudy, $pronouns, $position);

				header("Location: login.php");
				die;
			}
			else
			{
				$error = "Passwords do not match";
			}
		}
		else
		{
			$error = "Username or email already taken";
		}
	}
	else 
	{
		$error = "Please enter a valid username and password";
	}
}
?>
<!DOCTYPE html>
<html lang="en-gb">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sign Up - FeedTrac</title>

    <link rel="icon" type="image/x-icon" href="assets/icon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="stylesheets/main.css">

    <script src="https://kit.fontawesome.com/7e1870387e.js" crossorigin="anonymous"></script>
</head>
	<body>
		<!-- Header -->
		<?php include("header.php");?>

		<!-- Main -->
		<main>
			<h1>Sign Up</h1>

			<div class="form">
                <a href="login.php">Already signed up? Login here instead.</a>

                <!-- Form -->
				<form action="signup.php" method="post">
                    <label>Email
                        <input type="email" name="email" required>
                    </label>

                    <label>Username
                        <input type="text" name="username" required>
                    </label>

                    <label>Password<br>
                        <input type="password" id="password" name="password" required minlength="8">

                    <label style="display: inline-block; font-weight: normal;">
                        <input type="checkbox" onclick="togglePasswordVisibility('password')"> Show Characters
                    </label>
                    </label>

                    <label>Confirm Password<br>
                        <input type="password" id="confirmPassword" name="confirmPassword" required minlength="8">

                    <label style="display: inline-block; font-weight: normal;">
                        <input type="checkbox" onclick="togglePasswordVisibility('confirmPassword')"> Show Characters
                    </label>
                    </label>

                    <label>First Name
                        <input type="text" name="firstName" required>
                    </label>

                    <label>Last Name
                        <input type="text" name="lastName" required>
                    </label>

                    <!-- TODO: Going forwards the database will support choosing multiple courses, so we will need to modify this element to reflect that! -->
                    <label>Course
                        <select name="course" required>
                            <option value="">Please select...</option>
                            <?php
                            // Get all courses from the database
                            $courses = $Login_Controller->get_courses();

                            // Add each course as an option element
                            foreach ($courses as $course) {?>
                                <option value=<?php echo $course["courseID"] ?>><?php echo $course["name"] ?></option>
                            <?php } ?>
                        </select>
                    </label>

                    <label>Year of Study
                        <select name="yearOfStudy" required>
                            <option value="">Please select...</option>
                            <option value="1">1st</option>
                            <option value="2">2nd</option>
                            <option value="3">3rd</option>
                            <option value="4">4th</option>
                        </select>
                    </label>

                    <label>Pronouns
                        <select name="pronouns" required>
                            <option value="">Please select...</option>
                            <option value="hehim">He/Him</option>
                            <option value="sheher">She/Her</option>
                            <option value="other">Other</option>
                        </select>
                    </label>

                    <label>Position
                        <select name="position" required>
                            <option value="">Please select...</option>
                            <option value="student">Student</option>
                            <option value="staff">Staff</option>
                            <option value="admin">Admin</option>
                        </select>
                    </label>

                    <p style="color: red"><?php echo $error;?></p>

                    <input type="submit" value="Sign Up">
                </form>
			</div>
		</main>

        <!-- Footer -->
        <div class="footer-position"><?php include("footer.php");?></div>
    </body>
</html>
