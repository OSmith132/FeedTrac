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

     // Get all feedback items from the database
     public function get_inbox_feedback($dateTime){

        // Update the rating points of a feedback item
        return $this->get_all_rows_inbox($dateTime);
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
    

   // Filter Feedback
   public function row_passes_filters($feedbackRow, $resolved, $closed, $urgency, $timeframe){

    // Check if any input is empty
    if ($this->empty_input_check($feedbackRow, $resolved, $closed, $urgency, $timeframe)){
        header("location: index.php?error=emptyinput");
        exit();
    }

    // Check if resolved is valid if checked
    if ($feedbackRow['resolved'] != $resolved  &&  $resolved == 1){
        return false;
    }

    // Check if closed is valid if checked
    if ($feedbackRow['closed'] != $closed  &&  $closed == 1){
        return false;
    }

    // Check if urgency is valid
    if ($feedbackRow['urgency'] != $urgency  &&  $urgency != -1){ // or urgency is 'all'
        return false;
    }

    // ensure 'all time' allows for all


    if ($timeframe != 4){

        // Define Times for Timeframe
        $get_timeframe_string = array(
            "1 Hour",
            "1 Day",
            "1 Week",
            "1 Month"
        );

        // Get the string representation of the timeframe
        $timeframe = $get_timeframe_string[$timeframe];
    
        // If timeframe is all time, return true
    
            
        // Get the current timestamp
        $currentTimestamp = time();

        // Get the timestamp for the date $timeframe ago
        $timeframeTimestamp = strtotime("-" .$timeframe , $currentTimestamp);

        // Convert feedback row date to a timestamp
        $feedbackRowTimestamp = strtotime($feedbackRow['date']);

        // Check if the feedback row date is within the specified timeframe
        if ($feedbackRowTimestamp < $timeframeTimestamp) {
            // The feedback row date is within the timeframe
            // Return true or perform any other actions
            return false;
        }

    }


    return true;

    }

}