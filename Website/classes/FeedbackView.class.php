<?php 

class FeedbackView extends Feedback {

    private $userID;

    // Create a new feedback item off userID
    public function __construct($userID){
        $this->userID = $userID;
    }

    // Get all feedback items from the database
    public function get_all_feedback(){

       // Update the rating points of a feedback item
       return $this->get_all_rows();
   }

    // Gets all user info (including name, email, and course) for a feedback item
   public function get_user_info($feedbackID){

       // Check if any input is empty
       if ($this->empty_input_check($feedbackID)){
           header("location: feedback.php?error=emptyinput");
           exit();
       }

       // Update the rating points of a feedback item
       return $this->get_user($feedbackID);
   }


   public function search_feedback($searchTerm){

       // Check if any input is empty
       if ($this->empty_input_check($searchTerm)){
           return false;
       }

       // Update the rating points of a feedback item
       return $this->search($searchTerm);
   }
    
}