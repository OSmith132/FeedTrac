<?php 

// Controller class for Feedback. Use this to create and update new feedback items
class FeedbackContr extends Feedback {


    private $userID;
    

    // Create a new feedback item off userID
    public function __construct($userID){
        $this->userID = $userID;
    }


    // Create a new feedback item
    public function new_feedback($roomID, $date, $urgency, $resolved, $closed, $title, $text){

        // Check if any input is empty
        if ($this->empty_input_check($date, $urgency, $resolved, $closed, $title, $text)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

        // Create new feedback
        $this->create_feedback($this->userID, $roomID, $date, $urgency, $resolved, $closed, $title, $text);
    
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


    // Remove the rating points of a feedback item
    public function delete_rating($feedbackID, $userID){ // positiveRating: bool    feedbackID: int    userID: int

        // Check if any input is empty
        if ($this->empty_input_check($feedbackID, $userID)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

        // Update the rating points of a feedback item
        $this->remove_rating($feedbackID, $userID);
    }



    public function get_all_feedback(){

         // Check if any input is empty
         if ($this->empty_input_check()){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

        // Update the rating points of a feedback item
        return $this->get_all_rows();
    }


    public function get_user_info($feedbackID){

        // Check if any input is empty
        if ($this->empty_input_check($feedbackID)){
            header("location: feedback.php?error=emptyinput");
            exit();
        }

        // Update the rating points of a feedback item
        return $this->get_user($feedbackID);
    }
    

}