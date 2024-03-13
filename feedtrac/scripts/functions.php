<?php


// // check user is logged in when trying to access homepage
// function check_login($con){

//     //check if userId is set (user logged in)
//    if(isset($_SESSION['userID'])){

//         $id = $_SESSION['userID'];
//         $query = "SELECT * FROM user WHERE userID = '$id' LIMIT 1";
    
//         $result = mysqli_query($con, $query);
//         if($result && mysqli_num_rows($result) > 0)
//         {
//              $user_data = mysqli_fetch_assoc($result);
//              return $user_data;
//              die;
//         }

//    }


//     //redirect to login
//     header("Location: login.php");
//     die;
// }

// Check user isnt logged in when trying to access login or signup page
// function force_logout($con){

//     //check if userId is set (user logged in)
//    if(isset($_SESSION['userID'])){
//         header("Location: index.php");
//    }

// }


// GENERAL ARRAYS AND FUNCTIONS: =================================================================================================

// Get the string representation of the urgency level
$get_urgency_string = array(
     "Low",         // => 0
     "Medium",      // => 1
     "High",        // => 2
     "Critical"     // => 3
 );

 // Get the string representation of the resolved status
 $get_resolved_string = array(
     "Unresolved",            // => 0
     "Resolved",              // => 1
     "Resolved and closed",   // => 2
     "Force closed"           // => 3
 );


// Shorten strings to the desired length and add "..." to the end
function shorten($string, $maxLength) {
     if (strlen($string) > $maxLength) {
          $string = substr($string, 0, $maxLength) . '...';
     }
     return $string;
}
