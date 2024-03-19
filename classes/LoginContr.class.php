<?php 

class LoginContr extends Login {



    // Check if user is logged in and redirect to login if not
    public function force_login(){

        if(!isset($_SESSION['userID'])){
            header("Location: login.php");
            die;
        }
        
        $user_data = $this->get_user_data();
        
        // if data exists return it
        if ($user_data){
            return $user_data;
        }

        // if data doesn't exist redirect to login with error
        header("Location: login.php?error=NoDataFound");
        die;
    }

  
    // Check if user is logged in and redirect to index if they are
    public function check_login(){
        if(isset($_SESSION['user_id'])){
            header("Location: index.php");
        }
    }


    public function user_exists($userID){

         // Check if any input is empty
         if ($this->empty_input_check($userID)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

        return $this->check_user_exists($userID);

    }


    public function check_password($username, $password){

        // Check if any input is empty
        if ($this->empty_input_check($username, $password)){
           header("location: feedback.php?error=emptyinput");
           exit();
       }

       return $this->compare_password($username, $password);

   }

   // Get the user ID from username
   public function get_userid($username){

    // Check if any input is empty
    if ($this->empty_input_check($username)){
        header("location: feedback.php?error=emptyinput");
        exit();
    }

    return $this->get_id($username);
}
}