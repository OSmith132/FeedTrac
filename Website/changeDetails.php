<?php

session_start();


include ("classes/Database.class.php");
include ("classes/login.class.php");
include ("classes/LoginContr.class.php");
include ("classes/Feedback.class.php");
include ("classes/FeedbackContr.class.php");
include ("scripts/functions.php");


$Login_Controller = new LoginContr();
$user_data = $Login_Controller->force_login();
$User_ID = $user_data['userID'];
$message = "";


if($_SERVER['REQUEST_METHOD'] == "POST"){
    $postData = $_POST;
    if (count($postData) == count(array_filter($postData))) {
        $firstName = $postData['firstName'];
        $lastName = $postData['lastName'];
        $yearOfStudy = $postData['yearOfStudy'];
        $pronouns = $postData['pronouns'];
        $Login_Controller->update_user_info($firstName,$lastName,$yearOfStudy,$pronouns,$User_ID);
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
        <?php include("header.php"); ?>

        <!-- Main -->
        <main>
            <h1>Change Details</h1>
            <br>
            <br>
            <div class="form">

                <!-- Login Form -->
                <h2>Change Details:</h2><br><br>
                <form action="changeDetails.php" method="post">
                    First Name:
                    <input type="text" name="firstName" value="<?php echo $Login_Controller->get_current_user_first_name()?>" >
                    Last Name:
                    <input type="text" name="lastName" value="<?php echo $Login_Controller->get_current_user_last_name()?>" >

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

                    <div><?php echo $message ?></div>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </main>

        <!-- Footer -->
        <?php include("footer.php"); ?>
    </body>
</html>
