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
    
    }

    // Create a comment on feedback item
    public function new_comment($userID,$feedbackID, $text, $ratingPoints){

        // Check if any input is empty
        if ($this->empty_input_check($text)){
        header("location: feedback.php?error=emptyinput");
        exit();
    }

        // Create new feedback
        $this->create_comment($userID,$feedbackID, $text, $ratingPoints);
    
    }


    // Create a comment on feedback item
    public function find_comments($feedbackID){

        // Check if any input is empty
        if ($this->empty_input_check($feedbackID)){
        header("location: feedback.php?error=emptyinput");
        exit();
    }

        // Create new feedback
        return $this->get_comments($feedbackID);
    
    }

     // Create a new alert for subbed users
     public function sub_alert($userID){

         
         // Create new feedback
         $this->alert($userID);
     
     }

      // Create a new alert for subbed users
      public function feedback_get($feedbackID){

         
        // Create new feedback
        return $this->get_feedback($feedbackID);
    
    }

    // Update existing feedback item
    public function set_feedback($feedbackID, $roomID, $date, $urgency, $resolved, $closed, $title, $text){

        // Check if any input is empty
        if ($this->empty_input_check($feedbackID, $date, $urgency, $resolved, $closed, $title, $text)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

        // Create new feedback
        $this->update_feedback($feedbackID, $roomID, $date, $urgency, $resolved, $closed, $title, $text);
    
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
    }

    // Update the status to open or closed
    public function set_feedback_status($feedbackID,$newStatus){ // positiveRating: bool    feedbackID: int    userID: int

        // Check if any input is empty
        if ($this->empty_input_check($feedbackID, $newStatus)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }
        
        // Update the rating points of a feedback item
        $this-> update_feedback_status($feedbackID,$newStatus);
    }


    public function change_subscription_status($userID,$status){ // positiveRating: bool    feedbackID: int    userID: int

        
        
        // Update the rating points of a feedback item
        $this-> update_subscription_status($userID,$status);
    }



     // Update the resolved status of a feedback item
     public function set_feedback_resolved($feedbackID,$newResolved){ // positiveRating: bool    feedbackID: int    userID: int

        // Check if any input is empty
        if ($this->empty_input_check($feedbackID, $newResolved)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }
        
        // Update the rating points of a feedback item
        $this-> update_resolved($feedbackID,$newResolved);
    }

   


    // Remove the rating points of a feedback item
    public function delete_rating($feedbackID, $userID){ // positiveRating: bool    feedbackID: int    userID: int

        // Check if any input is empty
        if ($this->empty_input_check($feedbackID, $userID)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

        // Update the rating points of a feedback item
        $this->remove_rating($feedbackID, $userID);

        return true;
    }

    public function check_user_has_feedback_rating($feedbackID, $userID){
        return $this->check_user_given_feedback($feedbackID,$userID);
    }

    public function add_user_feedback_rating($feedbackID,$userID){
        $this->add_feedback_rating($feedbackID,$userID);
    }

    public function remove_user_feedback_rating($feedbackID, $userID){
        $this->remove_feedback_rating($feedbackID,$userID);
    }


    public function list_rooms(){ // positiveRating: bool    feedbackID: int    userID: int

        //Check if any input is empty
        if ($this->empty_input_check()){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

        return $this->get_rooms();

    }

    public function list_users($course){ // positiveRating: bool    feedbackID: int    userID: int

        //Check if any input is empty
        if ($this->empty_input_check($course)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

        return $this->get_users($course);

    }

    public function modify_date($feedbackID, $dateModified){ // positiveRating: bool    feedbackID: int    userID: int

        //Check if any input is empty
        if ($this->empty_input_check($feedbackID, $dateModified)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

        $this->update_feedback_dateModified($feedbackID, $dateModified);

        return true;

    }


    public function alert_reset($user){

        //Check if any input is empty
        if ($this->empty_input_check($user)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

        $this->alert_update($user);

        return true;

    }
    

}