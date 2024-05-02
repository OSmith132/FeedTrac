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
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FeedTrac</title>

    <link rel="icon" type="image/x-icon" href="assets/icon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="stylesheets/new.css">

    <script src="https://kit.fontawesome.com/7e1870387e.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Header -->
    <?php include("modules/newHeader.php");?>

    <!-- Main -->
    <main>
        <h1 class="title">Homepage</h1>
        
        <div class="index-main">
            <div class="index-header">

                <!-- Search-bar functionality -->
                <form class="index-header" method="POST" action="index.php" id="index-search-form" .change() >

                    <!-- Filter Methods -->
                    <div class="index-toggle-box">
                        <h2>Filter Options</h2>

                        <input type="hidden" name="action" value="search">

                        <input class="search-bar" type="text" name="searchTerm" placeholder="Search for existing feedback">

                        <!-- <button name="submit">Search</button> -->
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

                    </div>

                    <!-- Sort Methods -->
                    <div class="sort-box">
                        <h2>Sort Options</h2>

                            <!-- Sort by Rating Points -->
                            <div class="index-sort-option">
                                <label for="sort-type">Sort Type:</label>
                                <select id="sort-type" name="sort-type">
                                    <option value="relevance">Relevance</option>
                                    <option value="date">Date</option>  
                                    <option value="urgency">Urgency</option>
                                    <option value="ratingPoints">Rating</option>
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
                    </div>
                </form>

                <!-- New Feedback Button -->
                <button onclick="window.location.href = 'newFeedback.php'">New Feedback</button>
            </div>

            <!-- Table to show feedback -->
            <table class="search-table"></table>

            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include("modules/footer.php");?>

    <script>
        const rows = document.querySelectorAll(".clickable-row");
            rows.forEach(row => {
                row.addEventListener("click", () => {
                    window.location.href = row.dataset.href;
                });
            });
    </script>

    <!-- import AJAX -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Updates table when changing filters, sorting, and searching -->
    <script>
    $(document).ready(function() {
        // Function to update table
        function updateTable() {
            // Get filter values
            var formData = $("#index-search-form").serialize();

            // Send AJAX request
            $.ajax({
                type: "POST",
                url: "updateTable.php",
                data: formData,
                success: function(response) {
                    // Update table with the response
                    $(".search-table").html(response);
                }
            });
        }

        // Listen for changes in filter inputs
        $("#index-search-form input").on("change keyup", function() {
            // Update table whenever filter inputs change
            updateTable();
        });

        // Listen for changes in urgency slider
        $("#urgency").on("input", function() {
            // Update table whenever urgency slider changes
            updateTable();
        });

        // Listen for changes in timeframe slider
        $("#timeframe").on("input", function() {
            // Update table whenever timeframe slider changes
            updateTable();
        });

        // Listen for changes in resolved checkbox
        $("input[name='resolved']").on("change", function() {
            // Update table whenever resolved checkbox changes
            updateTable();
        });

        // Listen for changes in closed checkbox
        $("input[name='closed']").on("change", function() {
            // Update table whenever closed checkbox changes
            updateTable();
        });

        // Listen for changes in sort type dropdown
        $("#sort-type").on("change", function() {
            // Update table whenever sort type dropdown changes
            updateTable();
        });

        // Listen for changes in sort direction dropdown
        $("#Direction").on("change", function() {
            // Update table whenever sort direction dropdown changes
            updateTable();
        });

        // Initial table update
        updateTable();
    });
    </script>

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
</body>
</html>
