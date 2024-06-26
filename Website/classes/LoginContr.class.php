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

        return true;
    }


    // Check if the user exists
    public function user_exists($username){

         // Check if any input is empty
         if ($this->empty_input_check($username)){
            header("location: login.php?error=BadSQLQuery");
            exit();
        }

        return $this->check_user_exists($username);

    }

   

    // Sign up a user
    public function sign_up($email, $username, $hashed_password, $fname, $lname, $courseID, $yearOfStudy, $pronouns, $position){

        if ($this->empty_input_check($email, $username, $hashed_password, $fname, $lname, $courseID, $yearOfStudy, $pronouns, $position)){
            header("location: login.php?error=BadSQLQuery");
            exit();
        }

        // Return true if user created successfully
        return $this->create_user($email, $username, $hashed_password, $fname, $lname, $courseID, $yearOfStudy, $pronouns, $position);
   }


   // Check if the username and email are unique
    public function exists_username_email($username, $email){ // username: string, email: string

        // Check if any input is empty
        if ($this->empty_input_check($username)){
            header("location: login.php?error=BadSQLQuery");
            exit();     
        }

        // Return true if username and email are unique
        return $this->check_unique_email_username($username, $email);

    }


    // Check the password is correct
    public function check_password($username, $password){

        // Check if any input is empty
        if ($this->empty_input_check($username, $password)){
           header("location: login.php?error=BadSQLQuery");
           exit();
       }


       return $this->compare_password($username, $password);
   }

   // Get the user details
   public function get_feedback_user_details($userID){

    // Check if any input is empty
    if ($this->empty_input_check($userID)){
        header("location: login.php?error=BadSQLQuery");
        exit();
    }

    return $this->get_feedback_user_data($userID);
}


   // Get the user ID from username
   public function get_userid($username){

    // Check if any input is empty
    if ($this->empty_input_check($username)){
        header("location: login.php?error=BadSQLQuery");
        exit();
    }

    return $this->get_id_username($username);
}

 // Get the user ID from email
   public function get_userid_email($email){

    // Check if any input is empty
    if ($this->empty_input_check($email)){
        header("location: login.php?error=BadSQLQuery");
        exit();
    }
  
    return $this->get_id_email($email);
}

// Get the token using userID
   public function get_token($userID){

    // Check if any input is empty
    if ($this->empty_input_check($userID)){
        header("location: login.php?error=BadSQLQuery");
        exit();
    }
  
    return $this->get_recovery_code($userID);
}

    // Get all course data
    public function get_courses(){

        return $this->get_all_courses();
    }

  

     // Creates password recovery token
    public function create_recovery_token($email){

        
        // Check if any input is empty
        if ($this->empty_input_check($email)){
            header("location: login.php?error=BadSQLQuery");
            exit();
        }
 
        return $this->create_recovery_code($email);
        
    }

    // Clears used token.
    public function delete_recovery_record($userID){
       
        // Check if any input is empty
        if ($this->empty_input_check($userID)){
            header("location: login.php?error=BadSQLQuery");
            exit();
        }    

        return $this->delete_record($userID);
    }

     // Deletes account.
     public function delete_user_account($userID){
       
        // Check if any input is empty
        if ($this->empty_input_check($userID)){
            header("location: login.php?error=BadSQLQuery");
            exit();
        }    

        return $this->delete_account_id($userID);
    }

    // Updates user password
    public function update_user_password($hashed_password,$userID){

        // Check if any input is empty
        if ($this->empty_input_check($hashed_password,$userID)){
            header("location: login.php?error=BadSQLQuery");
            exit();
        }    
 
        return $this->update_password($hashed_password,$userID);
    }

    // Updates user bio
    public function update_user_bio($bio,$userID){

        // Check if any input is empty
        if ($this->empty_input_check($bio,$userID)){
            header("location: login.php?error=BadSQLQuery");
            exit();
        }

        return $this->update_bio($bio,$userID);
    }

    // Updates user info
    public function update_user_info($fname,$lname,$year,$pronoun,$userID){

        // Check if any input is empty
        if ($this->empty_input_check($fname,$lname,$year,$pronoun,$userID)){
            header("location: login.php?error=BadSQLQuery");
            exit();
        }

        return $this->update_info($fname,$lname,$year,$pronoun,$userID);
    }

    // Send recovery email [NOT FUNCTIONAL AS WE CAN'T SEND EMAILS FROM LOCALHOST]
    public function send_recovery_email($email){

        // Check if any input is empty
        if ($this->empty_input_check($email)){
            header("location: login.php?error=BadSQLQuery");
            exit();
        }

        // Get the recovery code
        $tokenString = strval($this->get_recovery_code($this->get_id_email($email)));

        // Set the email parameters
        $subject = "Feedtrac password recovery";
        $message = "Use this token to register a new password: " . $tokenString; // Concatenate strings
        $headers = 'From: feedtrac@example.com';

        // Send email
        /* mail($email, $subject, $message, $headers);*/
       echo $message; // THIS IS ONLY UNTIL WE HAVE A WORKING EMAIL SERVER (just a proof of concept as we can't send emails from localhost)

        return true;
        
    }

    // Get username of current user
    public function get_current_user_username(){
        return $this->get_column_from_id("username", $_SESSION['userID']);
    }

  

    // Get first name of current user
    public function get_current_user_first_name() {
        return $this->get_column_from_id("fName", $_SESSION['userID']);
    }

    // Get last name of current user
    public function get_current_user_last_name() {
        return $this->get_column_from_id("lName", $_SESSION['userID']);
    }



   

   

    


 
}