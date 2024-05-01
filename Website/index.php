<?php

session_start();

include("classes/Database.class.php");
include("classes/login.class.php");
include("classes/LoginContr.class.php");
include("classes/Feedback.class.php");
include("classes/FeedbackView.class.php");
include("scripts/functions.php");

$Login_Controller = new LoginContr();
$user_data = $Login_Controller->force_login();

$Feedback_View = new FeedbackView($user_data['userID']);




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

    <style>
        tr[data-href] {
            cursor: pointer;
        }
    </style>

    <script src="https://kit.fontawesome.com/7e1870387e.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Header -->
    <?php include("header.php"); ?>

    <!-- Main -->
    <main>
        <h1>[Show feedback items relevant to the user's course]</h1>
        
        <div class="index-main">
            <div class="index-header">

            

            
                <!-- Search-bar functionality -->
                <form class="index-header" method="POST" action="index.php" id="index-search-form">

                    <!-- Filter Methods -->
                    <div class="index-toggle-box">
                        <h2>Filter Options</h2>

                        <input type="hidden" name="action" value="search">

                        <input class="search-bar" type="text" name="searchTerm" placeholder="Search for existing feedback">

                        <button name="submit">Search</button>
                     </div>
                


                    <!-- Filter Methods -->
                    <div class="index-toggle-box">
                        <h2>Filter Options</h2>
                

                        <!-- Resolved/Unresolved Toggle -->
                        <div class="index-toggle-option">
                            <label>
                                <input type="checkbox" name="resolved" value="0" >Only Resolved
                            </label>
                        </div>

                        <!-- Closed Toggle -->
                        <div class="index-toggle-option">
                            <label>
                                <input type="checkbox" name="closed" value="0">Only Closed
                            </label>
                        </div>

                        <!-- Urgency Level Slider -->
                        <div class="index-toggle-option">
                            <label for="urgency">Urgency:</label>
                            <input type="range" id="urgency" name="urgency" min="-1" max="3" value="-1" list="urgency-levels">
                            <datalist id="urgency-levels">
                                <option value="-1">All</option>
                                <option value="0">Low</option>
                                <option value="1">Medium</option>
                                <option value="2">High</option>
                                <option value="3">Critical</option>
                            </datalist>
                            <span id="urgency-value">All</span>
                        </div>

                        <!-- Timeframe Slider -->
                        <div class="index-toggle-option">
                            <label for="timeframe">Timeframe:</label>
                            <input type="range" id="timeframe" name="timeframe" min="0" max="4" value="4" list="timeframe-options">
                            <datalist id="timeframe-options">
                                <option value="0">1 Hour</option>
                                <option value="1">1 Day</option>
                                <option value="2">1 Week</option>
                                <option value="3">1 Month</option>
                                <option value="4">All Time</option>
                            </datalist>
                            <span id="timeframe-value">All Time</span>
                        </div>

                        <!-- Submit -->
                        <!-- <button type="submit">Apply Filters</button> -->

                    
                </div>

            


                <!-- Sort Methods -->
                <div class="sort-box">
                    <h2>Sort Options</h2>

                        <!-- Sort by Rating Points -->
                        <div class="index-sort-option">
                            <label for="sort-type">Sort Type:</label>
                            <select id="sort-type" name="sort-type">
                                <option value="date">Date</option>
                                <option value="urgency">Urgency</option>
                                <option value="rating">Rating</option>
                            </select>
                        </div>


                        <!-- Direction -->
                        <div class="index-sort-option">
                            <label for="Direction">Direction:</label>
                            <select id="Direction" name="sort-direction">
                                <option value="asc">Ascending</option>
                                <option value="desc">Descending</option>
                            </select>
                        </div>

                        <!-- Submit -->
                        <!-- <button type="submit">Apply Sorting</button> -->


                    
                </div>


            </form>


                        

                New Feedback Button
                <button onclick="window.location.href = 'newFeedback.php'">New Feedback</button> 
            </div>






            <!-- Get result from database to fill table -->
            <?php


                       
                    

                    // If search button is pressed, get search term and display results
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'search') {

                        $searchTerm = $_POST['searchTerm'];


                        $feedbackRows = $Feedback_View->search_Feedback($searchTerm);


                        // If no search term entered, display all feedback
                        if (empty($searchTerm)) {
                            $feedbackRows = $Feedback_View->get_all_feedback();
                        }
                        // If no results found, display message
                        else if (empty($feedbackRows)) {
                            echo "<i>No results found for '" . $searchTerm . "'</i>";
                        }


                        // Filter Options
                        $resolved = isset($_POST['resolved']) ? 1 : 0;  
                        $closed = isset($_POST['closed']) ? 1 : 0;  
                        $urgency    = $_POST['urgency'];          // 0,1,2,3,4  =>  All, Low, Medium, High, Critical
                        $timeframe  = $_POST['timeframe'];        // 0,1,2,3,4  =>  1 Hour, 1 Day, 1 Week, 1 Month, All Time

                        // Sorting Options
                        $sortType    = $_POST['sort-type'];   
                        $sortDirection    = $_POST['sort-direction']; 
                        


                        // $_SESSION["resolved"]   = isset($_POST['resolved']);  // 0,1
                        // $_SESSION["closed"]     = isset($_POST['closed']);    // 0,1
                        // $_SESSION["urgency"]    = $_POST['urgency'];          // 0,1,2,3,4  =>  All, Low, Medium, High, Critical
                        // $_SESSION["timeframe"]  = $_POST['timeframe'];        // 0,1,2,3,4  =>  1 Hour, 1 Day, 1 Week, 1 Month, All Time

                        // output all options
                        echo "Search Term: " . $searchTerm . "<br>";
                        echo "Resolved: " . $resolved . "<br>";
                        echo "Closed: " . $closed . "<br>";
                        echo "Urgency: " . $urgency . "<br>";
                        echo "Timeframe: " . $timeframe . "<br>";
                        echo "Sort Type: " . $sortType . "<br>";
                        echo "Sort Direction: " . $sortDirection . "<br>";

                        
                        // Filter feedback rows
                        $feedbackRows = array_filter($feedbackRows, function($row) use ($Feedback_View, $resolved, $closed, $urgency, $timeframe) {
                            return $Feedback_View->row_passes_filters($row, $resolved, $closed, $urgency, $timeframe);
                        });

                        

                    } else {
                        $feedbackRows = $Feedback_View->get_all_feedback(); // Default action, if not searching
                    }



                    

                    
                    // Get user info for each feedback item
                    foreach ($feedbackRows as $row) {
                        $userInfo = $Feedback_View->get_user_info($row['feedbackID']);
                    ?>



            <div class="table" class="center">
                <table>

                    <!-- Table Headers -->
                    <tr>
                        <th>Status</th> <!-- Resolved + Urgency + closed-->
                        <th>Title</th> <!-- Title -->
                        <th>Text</th> <!-- Text -->
                        <th>Date</th> <!-- Date -->
                        <th>Rating Points</th> <!-- RatingPoints -->
                        <th>Comments</th> <!-- Number of comments -->
                        <th>Course</th> <!-- Course -->
                        <th>Author</th> <!-- Author -->
                    </tr>


                    



                        <tr class="clickable-row" data-href="feedback.php">

                            <td>
                                <?php echo  $get_urgency_string[$row['urgency']] . "<br>" // Resolved Status - Refer to functions.php for the array
                                    . $get_resolved_string[$row['resolved']]     . "<br>" // Urgency Level   - Refer to functions.php for the array
                                    . $get_closed_string[$row['closed']];                 // Closed Status   - Refer to functions.php for the array
                                ?>
                            </td>

                            <td><?php echo shorten($row['title'], 50); ?></td> <!-- shortens the title to 50 characters -->
                            <td><?php echo shorten($row['text'], 75); ?></td> <!-- shortens the text to 15 characters -->
                            <td><?php echo $row['date']; ?></td> <!-- Date -->
                            <td><?php echo $row['ratingPoints']; ?></td> <!-- Rating Points -->
                            <td><?php echo $row['number_of_comments']; ?></td> <!-- Number of comments -->
                            <td><?php echo $userInfo['name'] ?></td>
                            <td href="profile.php">
                                <div style="display: flex;"> <!-- MAKE THIS GO TO THE THE CORECT PROFILE-->

                                    <img style="margin-right: 10px;" class="avatar" src="<?php
                                                                                            // Get user info and find either jpg or png profile picture
                                                                                            $userID = $userInfo['userID'];
                                                                                            $jpg_path = "assets/profile-pictures/user-$userID.jpg";
                                                                                            $png_path = "assets/profile-pictures/user-$userID.png";

                                                                                            // Return the correct file path or default if neither found
                                                                                            if (file_exists($jpg_path)) {
                                                                                                echo $jpg_path;
                                                                                            } elseif (file_exists($png_path)) {
                                                                                                echo $png_path;
                                                                                            } else {
                                                                                                echo "assets/profile-pictures/user-default.jpg";
                                                                                            } ?>" alt="User Avatar" height="32" href="profile.php">


                                    <a href="profile.php"> <?php echo $userInfo['username']; ?> </a> <!-- Username -->
                                </div>
                            </td>

                        </tr>

                    <?php
                    }
                    ?>













                    <script>
                        const rows = document.querySelectorAll(".clickable-row");
                        rows.forEach(row => {
                            row.addEventListener("click", () => {
                                window.location.href = row.dataset.href;
                            });
                        });
                    </script>
                </table>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <div class="footer-position"><?php include("footer.php"); ?></div>
</body>

</html>




<!-- JS to change sliders when sliding -->
<script>
        //Update urgency value when slider is moved
        const urgencyInput = document.getElementById('urgency');
        const urgencyValue = document.getElementById('urgency-value');
        urgencyInput.addEventListener('input', () => {
            urgencyValue.textContent = 
            urgencyInput.value === '-1' ? 'All' :
            urgencyInput.value === '0' ? 'Low' : 
            urgencyInput.value === '1' ? 'Medium' :
            urgencyInput.value === '2' ? 'High':
            'Critial';
        });

        //Update timeframe value when slider is moved
        const timeframeInput = document.getElementById('timeframe');
        const timeframeValue = document.getElementById('timeframe-value');
        timeframeInput.addEventListener('input', () => {
            timeframeValue.textContent = 
            timeframeInput.value === '0' ? '1 Hour' : 
            timeframeInput.value === '1' ? '1 Day' : 
            timeframeInput.value === '2' ? '1 Week' : 
            timeframeInput.value === '3' ? '1 Month' : 
            'All Time';
        });
</script>




