<?php 

// Controller class for Feedback. Use this to create and update new feedback items
class FeedbackContr extends Feedback {


    private $userID;
    

    // Create a new feedback item off userID
    public function __construct($userID){
        $this->userID = $userID;
    }


    // Create a new feedback item
    public function new_feedback($roomID, $urgency, $resolved, $closed, $title, $text){

       // Check if any input is empty
       if ($this->empty_input_check($urgency, $resolved, $closed, $title, $text)){
        header("location: feedback.php?error=emptyinput");
        exit();
    }

        // Create new feedback
        $this->create_feedback($this->userID, $roomID, $urgency, $resolved, $closed, $title, $text);

        return true;
    
    }

    // Create a comment on feedback item
    public function new_comment($userID,$feedbackID, $text, $ratingPoints){

        // Check if any input is empty
        if ($this->empty_input_check($text)){
        header("location: feedback.php?error=emptyinput");
        exit();
    }

        // Create new comment
        $this->create_comment($userID,$feedbackID, $text, $ratingPoints);

        return true;
    
    }


    // Find all comments on a feedback item
    public function find_comments($feedbackID){

        // Check if any input is empty
        if ($this->empty_input_check($feedbackID)){
        header("location: feedback.php?error=emptyinput");
        exit();
    }

        // return comments
        return $this->get_comments($feedbackID);
    
    }

     // Create a new alert for subbed users
     public function sub_alert($userID){

        // Check if any input is empty
        if ($this->empty_input_check($userID)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

         
         // add alert
         $this->alert($userID);
     
         return true;
     }

      // Get feedback item
      public function feedback_get($feedbackID){

        // Check if any input is empty
        if ($this->empty_input_check($feedbackID)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

         
        // Return feedback item
        return $this->get_feedback($feedbackID);
    
    }

 

    // Delete Feedback Item
    public function remove_feedback($feedbackID){ 

        // Check if any input is empty
        if ($this->empty_input_check($feedbackID)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }
        
        // Calls feedback class to delete item
        $this-> delete_feedback($feedbackID);
    }

    // Delete comment
    public function remove_comment($commentID){ 

        // Check if any input is empty
        if ($this->empty_input_check($commentID)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }
        
        // Calls feedback class to delete comment
        $this-> delete_comment($commentID);

        return true;
    }

    // Update the rating points of a feedback item
    public function set_rating($positiveRating, $feedbackID, $userID){ // positiveRating: bool    feedbackID: int    userID: int

        // Check if any input is empty
        if ($this->empty_input_check($positiveRating, $feedbackID, $userID)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

        // Update the rating points of a feedback item
        $this->update_rating($positiveRating, $feedbackID, $userID);

        return true;
    }

    // Update the status to open or closed
    public function set_feedback_status($feedbackID,$newStatus){ // positiveRating: bool    feedbackID: int    userID: int

        // Check if any input is empty
        if ($this->empty_input_check($feedbackID, $newStatus)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }
        
        // Update the closed status of a feedback item
        $this-> update_feedback_status($feedbackID,$newStatus);

        return true;
    }

    // Update the subscription status of a feedback item
    public function change_subscription_status($userID,$status){ // positiveRating: bool    feedbackID: int    userID: int

        // Check if any input is empty
        if ($this->empty_input_check($userID, $status)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }
        
        
        // Update the subscriptions status of a user
        $this-> update_subscription_status($userID,$status);

        return true;
    }


    // Update the resolved status of a feedback item
    public function set_feedback_resolved($feedbackID,$newResolved){ // positiveRating: bool    feedbackID: int    userID: int

        // Check if any input is empty
        if ($this->empty_input_check($feedbackID, $newResolved)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }
        
        // Update the resolved status of a feedback item
        $this-> update_resolved($feedbackID,$newResolved);

        return true;
    }

    // Check if a user has given feedback rating
    public function check_user_has_feedback_rating($feedbackID, $userID){

        //Check if any input is empty
        if ($this->empty_input_check($feedbackID, $userID)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

        // return true if user has given feedback rating
        return $this->check_user_given_feedback($feedbackID,$userID);
    }

    // Add a feedback rating to a feedback item
    public function add_user_feedback_rating($feedbackID,$userID){

        //Check if any input is empty
        if ($this->empty_input_check($feedbackID, $userID)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

        // adds a feedback rating to feedback item
        $this->add_feedback_rating($feedbackID,$userID);
    }

    // Remove a feedback rating from a feedback item
    public function remove_user_feedback_rating($feedbackID, $userID){

        //Check if any input is empty
        if ($this->empty_input_check($feedbackID, $userID)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

        $this->remove_feedback_rating($feedbackID,$userID);
    }

    // List all rooms 
    public function list_rooms(){ // positiveRating: bool    feedbackID: int    userID: int

        //Check if any input is empty
        if ($this->empty_input_check()){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

        // return all rooms
        return $this->get_rooms();
    }

    // List all users
    public function list_users($course){ // positiveRating: bool    feedbackID: int    userID: int

        //Check if any input is empty
        if ($this->empty_input_check($course)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

        // Return all users
        return $this->get_users($course);

    }

    // Modify the date modified of a feedback item
    public function modify_date($feedbackID, $dateModified){ // positiveRating: bool    feedbackID: int    userID: int

        //Check if any input is empty
        if ($this->empty_input_check($feedbackID, $dateModified)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

        // Update the date modified of a feedback item
        $this->update_feedback_dateModified($feedbackID, $dateModified);

        return true;

    }

    // Resets alerts back to 0
    public function alert_reset($user){

        //Check if any input is empty
        if ($this->empty_input_check($user)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

        // Reset alerts
        $this->alert_update($user);

        return true;

    }
    

}