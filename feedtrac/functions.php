<?php


// check user is logged in when trying to access homepage
function check_login($con){

    //check if userId is set (user logged in)
   if(isset($_SESSION['userID'])){

        $id = $_SESSION['userID'];
        $query = "SELECT * FROM user WHERE userID = '$id' LIMIT 1";
    
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
             $user_data = mysqli_fetch_assoc($result);
             return $user_data;
             die;
        }

   }


    //redirect to login
    header("Location: login.php");
    die;
}

// Check user isnt logged in when trying to access login or signup page
function force_logout($con){

    //check if userId is set (user logged in)
   if(isset($_SESSION['userID'])){
        header("Location: index.php");
   }

}