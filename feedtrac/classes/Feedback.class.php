<?php 

class Feedback extends Database {



    // Get feedback from the database on feedbackID
    protected function get_feedback($feedbackID){

        // Connect  to database and retrieves all data about feedback
        $stmt = self::connect()->prepare("SELECT * FROM feedback WHERE feedbackID = ?");

        // Check if the SQL query is valid
        if(!$stmt->execute([$feedbackID])){
            header("location: profile.php?error=BadSQLQuery");
            exit();
        }

        // Check if there are any results
       if($stmt->num_rows() == 0){
            header("location: profile.php?error=NoFeedbackFound");
            exit();
        }

        // Return the results
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $results;

    }


    // Update existing feedback (use update_rating() to update the rating points)
    protected function update_feedback($feedbackID, $userID, $roomID, $date, $urgency, $resolved, $closed, $title, $text){

        // Connect  to database and update all data about a feedback item
        $stmt = $this->connect()->prepare("UPDATE feedback SET userID = ?, roomID = ?, date = ?, urgency = ?, resolved = ?, closed = ?, title = ?, text = ? WHERE feedbackID = ?");

        // Check if the SQL query is valid
        if(!$stmt->execute([$feedbackID, $userID, $roomID, $date, $urgency, $resolved, $closed, $title, $text])){
            header("location: profile.php?error=BadSQLQuery");
            exit();
        }

       $stmt = null;

    }


    




    // Update the rating points of a feedback item
    protected function update_rating($positiveRating, $feedbackID, $userID){ // positiveRating: bool    feedbackID: int    userID: int


            // TODO: 1) remove current rating of user
            //       2) add new rating of user
            //       3) update feedback rating points
            //       4) positive rating should allow for null / 0 input to remove user rating without adding a new one (maybe seperate function?)



            if ($positiveRating){
                $ratingValue = 1;
            } 
            else if (!$positiveRating){
                $ratingValue = -1;
            }

            // Update the rating points of a feedback item
            $stmt = $this->connect()->prepare("UPDATE feedback SET ratingPoints = ratingPoints + ? WHERE feedbackID = ?");

            // Check if the SQL query is valid and execute
            if(!$stmt->execute([$ratingValue, $feedbackID])){
                header("location: feedback.php?error=BadSQLQuery");
                exit();
            }


            // Update the feedback_user_rating table values
            $stmt = $this->connect()->prepare("UPDATE feedback_user_rating SET positiveRating = ? WHERE feedbackID = ? and userID = ?");

            // Check if the SQL query is valid and execute
            if(!$stmt->execute([$positiveRating, $feedbackID, $userID])){
                header("location: feedback.php?error=BadSQLQuery");
                exit();
            }


        $stmt = null;

    }


    



    // Create new feedback
    protected function create_feedback($userID, $roomID, $date, $urgency, $resolved, $closed, $title, $text){

        // Connect  to database and create new feedback item
        $stmt = $this->connect()->prepare("INSERT INTO feedback (feedbackID, userID, roomID, date, urgency, resolved, closed, title, text, ratingPoints) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1)");

        // Check if the SQL query is valid
        if(!$stmt->execute([$userID, $roomID, $date, $urgency, $resolved, $closed, $title, $text])){
            header("location: profile.php?error=BadSQLQuery");
            exit();
        }

    $stmt = null;

}


}