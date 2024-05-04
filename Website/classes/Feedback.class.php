<?php

class Feedback extends Database
{



    // Get feedback from the database on feedbackID
    protected function get_feedback($feedbackID)
    {

        // Connect  to database and retrieves all data about feedback
        $stmt = $this->connect()->prepare("SELECT * FROM feedback WHERE feedbackID = ?");

        // Check if the SQL query is valid
        if (!$stmt->execute([$feedbackID])) {
            header("location: profile.php?error=BadSQLQuery");
            exit();
        }      

        // Return the results
        $results = $stmt->get_result()->fetch_assoc();
        return $results;
    }

    // Get feedback from the database on feedbackID
    protected function get_comments($feedbackID)
    {

        // Connect  to database and retrieves all data about feedback
        $stmt = $this->connect()->prepare("SELECT * FROM comment WHERE feedbackID = ?");

        // Check if the SQL query is valid
        if (!$stmt->execute([$feedbackID])) {
            header("location: profile.php?error=BadSQLQuery");
            exit();
        }      

        // Return the results
        // Return the results
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $results;
    }


    // Update existing feedback (use update_rating() to update the rating points)
    protected function update_feedback($feedbackID, $roomID, $date, $urgency, $resolved, $closed, $title, $text)
    {

        // Connect  to database and update all data about a feedback item
        $stmt = $this->connect()->prepare("UPDATE feedback SET roomID = ?, date = ?, urgency = ?, resolved = ?, closed = ?, title = ?, text = ? WHERE feedbackID = ?");

        // Check if the SQL query is valid
        if (!$stmt->execute([$roomID, $date, $urgency, $resolved, $closed, $title, $text, $feedbackID])) {
            header("location: profile.php?error=BadSQLQuery");
            exit();
        }

        $stmt = null;
    }

    // Update existing feedback modified date
    protected function update_feedback_dateModified($feedbackID, $dateModified)
    {
        // Convert DateTime object to string
        $dateModifiedStr = $dateModified->format('Y-m-d H:i:s');
    
        // Connect to database and update all data about a feedback item
        $stmt = $this->connect()->prepare("UPDATE feedback SET modifiedDate = ? WHERE feedbackID = ?");
    
        // Check if the SQL query is valid
        if (!$stmt->execute([$dateModifiedStr, $feedbackID])) {
            header("location: profile.php?error=BadSQLQuery");
            exit();
        }
    
        $stmt = null;
    }

    // Update existing feedback modified date
    protected function update_feedback_status($feedbackID,$newStatus)
    {
        // Connect to database and update all data about a feedback item
        $stmt = $this->connect()->prepare("UPDATE feedback SET closed = ? WHERE feedbackID = ?");
    
        // Check if the SQL query is valid
        if (!$stmt->execute([$newStatus, $feedbackID])) {
            header("location: profile.php?error=BadSQLQuery");
            exit();
        }
    
        $stmt = null;
    }

    // A method to reset alerts
    protected function alert_update($user){

        // Connect to database and update all data about a feedback item
        $stmt = $this->connect()->prepare("UPDATE user SET alert = 0 WHERE userID = ?");
    
        // Check if the SQL query is valid
        if (!$stmt->execute([$user])) {
            header("location: profile.php?error=BadSQLQuery");
            exit();
        }
    
        $stmt = null;

    } 



    // Create new feedback
    protected function create_feedback($userID, $roomID, $urgency, $resolved, $closed, $title, $text)
    {

        // Connect  to database and create new feedback item
        $stmt = $this->connect()->prepare("INSERT INTO feedback (userID, roomID, urgency, resolved, closed, title, text, ratingPoints) VALUES (?, ?, ?, ?, ?, ?, ?, 0)");

        // Check if the SQL query is valid
        if (!$stmt->execute([$userID, $roomID, $urgency, $resolved, $closed, $title, $text])) {
            header("location: profile.php?error=BadSQLQuery");
            exit();
        }

        $stmt = null;
    }

     // Create new comment
     protected function create_comment($userID,$feedbackID,$text,$ratingPoints)
     {
 
         // Connect  to database and create new feedback item
         $stmt = $this->connect()->prepare("INSERT INTO comment (userID, feedbackID, text, ratingPoints) VALUES (?, ?, ?, ?)");
 
         // Check if the SQL query is valid
         if (!$stmt->execute([$userID, $feedbackID, $text, $ratingPoints])) {
             header("location: profile.php?error=BadSQLQuery");
             exit();
         }
 
         $stmt = null;
     }

    // Create new inbox alert
    protected function alert($userID)
    {
        $stmt = $this->connect()->prepare("UPDATE user SET alert = alert + 1 where userID = ? ");

         // Check if the SQL query is valid and execute
         if (!$stmt->execute([$userID])) {
            header("location: feedback.php?error=BadSQLQuery");
            exit();
        }

    }



    // Update the rating points of a feedback item
    protected function update_rating($positiveRating, $feedbackID, $userID)
    { // positiveRating: bool    feedbackID: int    userID: int


        // Check if the user has already rated the feedback item and remove if true
        if ($this->query("SELECT positiveRating FROM feedback_user_rating WHERE feedbackID = ? and userID = ?")) {
            $this->remove_rating($feedbackID, $userID);
        }

        // Check if the user has rated the feedback item positively or negatively
        if ($positiveRating) {
            $ratingValue = 1;
        } else if (!$positiveRating) {
            $ratingValue = -1;
        }


        // Update the feedback_user_rating table values
        $stmt = $this->connect()->prepare("INSERT INTO feedback (feedbackID, userID, positiveRating) VALUES feedbackID = ?, userID = ?, positiveRating = ?");

        // Check if the SQL query is valid and execute
        if (!$stmt->execute([$positiveRating, $feedbackID, $userID])) {
            header("location: feedback.php?error=BadSQLQuery");
            exit();
        }


        // Update the rating points of a feedback item
        $stmt = $this->connect()->prepare("UPDATE feedback SET ratingPoints = ratingPoints + ? WHERE feedbackID = ?");

        // Check if the SQL query is valid and execute
        if (!$stmt->execute([$ratingValue, $feedbackID])) {
            header("location: feedback.php?error=BadSQLQuery");
            exit();
        }


        $stmt = null;
    }


    protected function remove_rating($feedbackID, $userID)
    {

        // Check if the user has rated the feedback item positively or negatively
        if ($this->query("SELECT positiveRating FROM feedback_user_rating WHERE feedbackID = ? and userID = ?")) {
            $ratingValue = -1;
        } else {
            $ratingValue = 1;
        }


        // Remove the saved rating value of the user
        $stmt = $this->connect()->prepare("DELETE FROM feedback_user_rating WHERE feedbackID = ? and userID = ?");

        // Check if the SQL query is valid and execute
        if (!$stmt->execute([$feedbackID, $userID])) {
            header("location: feedback.php?error=BadSQLQuery");
            exit();
        }


        // Update the rating points of a feedback item
        $stmt = $this->connect()->prepare("UPDATE feedback SET ratingPoints = ratingPoints + ? WHERE feedbackID = ?");

        // Check if the SQL query is valid and execute
        if (!$stmt->execute([$ratingValue, $feedbackID])) {
            header("location: feedback.php?error=BadSQLQuery");
            exit();
        }
    }

    protected function get_rooms()
   {

        $stmt = $this->connect()->prepare("SELECT roomID, roomName FROM room");

        // Check if the SQL query is valid and execute
        if (!$stmt->execute()) {
            header("location: feedback.php?error=BadSQLQuery");
            exit();
        }


        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $results;
    }


    protected function get_users($course)
    {
 
         $stmt = $this->connect()->prepare("SELECT *  FROM user where courseID = ? ");
 
         // Check if the SQL query is valid and execute
        if (!$stmt->execute([$course])) {
            header("location: feedback.php?error=BadSQLQuery");
            exit();
        }
 
 
         $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
         return $users;
    }


    // Connect  to database and retrieves all data about the user who created the feedback
    protected function get_user($feedbackID)
    {

        $stmt = $this->connect()->prepare(" SELECT 
                                                user.userID,
                                                username,
                                                fname,
                                                lname,
                                                yearOfStudy,
                                                course.name AS name,
                                                pronouns,
                                                position,
                                                name
                                            FROM 
                                                user
                                            JOIN 
                                                feedback
                                            ON 
                                                user.userID = feedback.userID 
                                            JOIN
                                                course
                                            ON
                                                user.courseID = course.courseID
                                            WHERE 
                                                feedbackID = ?");

        // Check if the SQL query is valid and execute
        if (!$stmt->execute([$feedbackID])) {
            header("location: feedback.php?error=BadSQLQuery");
            exit();
        }

        $results = $stmt->get_result()->fetch_assoc();
        return $results;
    }




    protected function get_all_rows()
    {

        // Update the rating points of a feedback item
        $stmt = $this->connect()->prepare(" SELECT 
                                                feedback.feedbackID, 
                                                resolved, 
                                                urgency, 
                                                closed,
                                                title, 
                                                feedback.text, 
                                                feedback.date, 
                                                feedback.ratingPoints, 
                                                COUNT(commentID) 
                                            as 
                                                number_of_comments 
                                            FROM 
                                                feedback 
                                            LEFT JOIN 
                                                comment 
                                            ON 
                                                feedback.feedbackID = comment.feedbackID 
                                            GROUP BY 
                                                feedback.feedbackID;");

        // Check if the SQL query is valid and execute
        if (!$stmt->execute()) {
            header("location: feedback.php?error=BadSQLQuery");
            exit();
        }

        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $results;
    }
    protected function get_all_rows_inbox($dateTime)
    {
        // Prepare an SQL statement to select all feedback where the date is greater than $dateTime
        $stmt = $this->connect()->prepare("SELECT * from feedback
                                            WHERE 
                                                modifiedDate > ? or feedback.date > ?
                                            GROUP BY 
                                                feedback.feedbackID;");
    
        // Check if the SQL query is valid and execute
        if (!$stmt->execute([$dateTime,$dateTime])) {
            header("location: feedback.php?error=BadSQLQuery");
            exit();
        }
    
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $results;
    }
    



    protected function search($searchTerm)
    {

        // Update the rating points of a feedback item
        $stmt = $this->connect()->prepare(" SELECT 
                                                feedback.feedbackID, 
                                                resolved, 
                                                urgency,
                                                closed,
                                                title, 
                                                feedback.text,
                                                feedback.date, 
                                                feedback.ratingPoints, 
                                                COUNT(commentID) as number_of_comments 
                                            FROM 
                                                feedback 
                                            LEFT JOIN 
                                                comment
                                            ON 
                                                feedback.feedbackID = comment.feedbackID 
                                            WHERE 
                                                title 
                                            LIKE 
                                                CONCAT('%', ?, '%')
                                            OR 
                                                feedback.text 
                                            LIKE 
                                                CONCAT('%', ?, '%')
                                            GROUP BY 
                                                feedback.feedbackID
                                            ORDER BY
                                                CASE WHEN title LIKE CONCAT(?, '%') THEN 0 ELSE 1 END, 
                                                title,
                                                CASE WHEN feedback.text LIKE CONCAT(?, '%') THEN 0 ELSE 1 END, 
                                                feedback.text;
                                            ");

        // Check if the SQL query is valid and execute
        if (!$stmt->execute([$searchTerm, $searchTerm, $searchTerm, $searchTerm])) {
            header("location: feedback.php?error=BadSQLQuery");
            exit();
        }

        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $results;
    }
}
