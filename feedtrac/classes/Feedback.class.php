<?php 

class Feedback extends Database {

    // Get feedback from the database from ID
    protected function getFeedback($feedbackID){

        // Connect  to database and retrieve 
        $stmt = $this->connect()->prepare("SELECT * FROM feedback WHERE feedbackID = ?");

        // Check if the SQL query is valid
        if(!$stmt->execute([$feedbackID])){
            header("location: profile.php?error=BadSQLQuery");
            exit();
        }

        // Check if there are any results
       if($stmt->rowCount() == 0){
            header("location: profile.php?error=NoFeedbackFound");
            exit();
        }

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;

    }

    // Set feedback 
    protected function updateFeedback($feedbackID, $userID, $Date, $title, $text){

        // Connect  to database and retrieve 
        $stmt = $this->connect()->prepare("UPDATE feedback SET feedbackID = ?, userID = ?, Date = ?, title = ?, text = ? WHERE feedbackID = ?");

        // Check if the SQL query is valid
        if(!$stmt->execute([$feedbackID, $userID, $Date, $title, $text])){
            header("location: profile.php?error=BadSQLQuery");
            exit();
        }

       $stmt = null;

    }


}