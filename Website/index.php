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

    <link rel="stylesheet" href="stylesheets/main.css">

    <script src="https://kit.fontawesome.com/7e1870387e.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Header -->
    <?php include("header.php"); ?>

    <!-- Main -->
    <main class="index-main">
        <!-- Title -->
        <h1>Welcome to FeedTrac</h1>

        <!-- New Feedback Button -->
        <button class="new-feedback-button" onclick="window.location.href = 'newFeedback.php';">Create New Feedback</button>

        <!-- Search-bar functionality -->
        <form class="index-options" method="POST" action="index.php" id="index-search-form" .change() >
            <div class="index-options-group">
                <!-- Filter -->
                <div class="index-option-box">
                    <h2>Filter</h2>

                    <!-- Resolved/Unresolved Toggle -->
                    <div>
                        <label>
                            <input type="checkbox" name="resolved" value="0" >Only Unresolved
                        </label>
                    </div>

                    <!-- Closed Toggle -->
                    <div>
                        <label>
                            <input type="checkbox" name="closed" value="0">Only Open
                        </label>
                    </div>

                    <!-- Urgency Level Slider -->
                    <div>
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
                    <div>
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

                <!-- Sort -->
                <div class="index-option-box">
                    <h2>Sort</h2>

                    <!-- Sort by Rating Points -->
                    <div>
                        <label for="sort-type">Focus:</label>
                        <select id="sort-type" name="sort-type">
                            <option value="relevance">Relevance</option>
                            <option value="date">Date</option>
                            <option value="urgency">Urgency</option>
                            <option value="ratingPoints">Rating</option>
                        </select>
                    </div>

                    <!-- Direction -->
                    <div>
                        <label for="Direction">Direction:</label>
                        <select id="Direction" name="sort-direction">
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Search -->
            <div class="index-option-box">
                <h2>Search</h2>

                <input type="hidden" name="action" value="search">

                <input class="index-search-bar" type="text" name="searchTerm" placeholder="Search for existing feedback...">

                <!-- <button name="submit">Search</button> -->
            </div>
        </form>

        <!-- Table to show feedback -->
        <table class="search-table"></table>
    </main>

    <!-- Footer -->
    <?php include("footer.php"); ?>

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

    document.querySelector('.search-table').addEventListener('click', function(event) {
        console.log('Row clicked!');

        // Select closest element with clickable-row to the clicked element
        var clickableRow = event.target.closest('.clickable-row');

        if (clickableRow) {
            // Get the data-id attribute
            var feedbackID = clickableRow.dataset.id;

            // Redirect to feedback.php with the ID as variable
            window.location.href = "feedback.php?id=" + feedbackID;
        }
    });
    </script>
</body>
</html>
