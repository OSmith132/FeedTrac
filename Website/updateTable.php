<?php
    include("classes/Database.class.php");
    include("classes/login.class.php");
    include("classes/LoginContr.class.php");
    include("classes/Feedback.class.php");
    include("classes/FeedbackView.class.php");
    include("scripts/functions.php");

    SESSION_START();
    $Feedback_View = new FeedbackView($_SESSION['userID']);


    // Search Options
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
    
    // Filter feedback rows
    $feedbackRows = array_filter($feedbackRows, function($row) use ($Feedback_View, $resolved, $closed, $urgency, $timeframe) {
        return $Feedback_View->row_passes_filters($row, $resolved, $closed, $urgency, $timeframe);
    });



   // Sorting Options
    $sortType    = $_POST['sort-type'];   
    $sortDirection    = $_POST['sort-direction']; 

    // Sort feedback rows if not sorting by relevance
    if($sortType != 'relevance'){

        // Sort by date
        if ($sortType == 'date'){

            usort($feedbackRows , function($a, $b) use ($sortType) {
                $dateTimeA = strtotime($a[$sortType]);
                $dateTimeB = strtotime($b[$sortType]);
                
                // Check if both values are valid timestamps
                if ($dateTimeA === false || $dateTimeB === false) {
                    return 0; // If either is not a valid timestamp, return 0 (no change in order)
                }
                
                // Compare timestamps
                return $dateTimeA - $dateTimeB;
            });
        }

        // Sort by rating points Or number of comments
        else{

            usort($feedbackRows , function($a, $b) use ($sortType) {
                return $a[$sortType] - $b[$sortType];
            });
        }
    }

    // Reverse the array if sorting by descending order
    if ($sortDirection == 'desc') {
        $feedbackRows = array_reverse($feedbackRows);
    }


// Define html
$html = '';



// Check if feedback is empty
if (empty($feedbackRows)) {
    echo "</table><i>No results found match the filters provided</i><table>";
}

else{
    // Add table headers
    $html .= '
            <tr>
                <th>Status</th> 
                <th>Title</th> 
                <th>Text</th>
                <th>Date</th> 
                <th>Rating Points</th> 
                <th>Comments</th> 
                <th>Course</th> 
                <th>Author</th> 
            </tr>
            ';
}

// Get user info for each feedback item
foreach ($feedbackRows as $row) {
    $userInfo = $Feedback_View->get_user_info($row['feedbackID']);


    
    $html .= '<tr class="clickable-row" data-id="';
    $html .=  $row['feedbackID'];
    $html .=  '">'; 


        // Status 
        $html .= '<td>';
        $html .= $get_urgency_string[$row['urgency']]   . "<br>" // Resolved Status - Refer to functions.php for the array
            .  $get_resolved_string[$row['resolved']] . "<br>" // Urgency Level   - Refer to functions.php for the array
            .  $get_closed_string[$row['closed']];
        $html .= '</td>';         
              
        
            
        // Title
        $html .= '<td>';
        $html .= shorten($row['title'], 50);
        $html .= '</td>';



        // Text 
        $html .= '<td>';
        $html .= shorten($row['text'], 75);
        $html .= '</td>';



        // Date
        $html .= '<td>';
        $html .= $row['date'];
        $html .= '</td>';



        // Rating Points
        $html .= '<td>';
        $html .= $row['ratingPoints'];
        $html .= '</td>';



        // Comments
        $html .= '<td>';
        $html .= $row['number_of_comments'];
        $html .= '</td>';



        // Course
        $html .= '<td>';
        $html .= $userInfo['name'];
        $html .= '</td>';



        // Author Row
        $html .= '<td href="profile.php">';
        $html .= '<div style="display: flex;">';
        $html .= '<img style="margin-right: 10px;" class="avatar" src="';

        // Get user info and find either jpg or png profile picture
        $userID = $userInfo['userID'];
        $jpg_path = "assets/profile-pictures/user-$userID.jpg";
        $png_path = "assets/profile-pictures/user-$userID.png";

        // Return the correct file path or default if neither found
        if (file_exists($jpg_path)) {
            $html .= $jpg_path;
        } elseif (file_exists($png_path)) {
            $html .= $png_path;
        } else {
            $html .= "assets/profile-pictures/user-default.jpg";
        }

        $html .= '" alt="User Avatar" height="32" href="';
        $html .= 'profile.php?id=' . $userInfo['userID'];
        $html .=  '">'; 



        // Author Name
        $html .= '<a href="';
        $html .= 'profile.php?id=' . $userInfo['userID'];
        $html .=  '">'; 
        $html .= $userInfo['username'];
        $html .= '</a>';
        $html .= '</div>';
        $html .= '</td>';
        
    $html .= '</tr>';
    

}



// Echo the generated HTML
    echo $html;

