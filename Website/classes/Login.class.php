<?php 

class Login extends Database {



    // Check if user is logged in and redirect to login if not
    protected function get_user_data(){ 

        if(isset($_SESSION['userID'])){
            
            //prepare the SQL query
            $stmt = $this->connect()->prepare("SELECT * FROM user WHERE userID = ?  limit 1");

            // Check if the SQL query is valid
            if(!$stmt->execute([$_SESSION['userID']])){
                header("location: login.php?error=BadSQLQuery");
                exit(); 
            }

            $result = $stmt->get_result();

            if(mysqli_num_rows($result) > 0){
                $user_data = $result -> fetch_assoc();
                return $user_data;
            }
        }
        
        //redirect to login
        header("Location: login.php");
        die; 
        
    }

    // Get user data from userID
    protected function get_feedback_user_data($userID){

        if(isset($_SESSION['userID'])){
            
            //prepare the SQL query
            $stmt = $this->connect()->prepare("SELECT * FROM user WHERE userID = ?  limit 1");

            // Check if the SQL query is valid
            if(!$stmt->execute([$userID])){
                header("location: login.php?error=BadSQLQuery");
                exit(); 
            }

            $result = $stmt->get_result();

            // return user data 
            if(mysqli_num_rows($result) > 0){
                $user_data = $result -> fetch_assoc();
                return $user_data;
            }
        }
        
        //redirect to login
        header("Location: login.php");
        die;
        
    }


    // Add new user to database
    protected function create_user($email, $username, $hashed_password, $fname, $lname, $courseID, $yearOfStudy, $pronouns, $position){

         // prepare the SQL query
         $stmt = $this->connect()->prepare("INSERT INTO user (email, username, passwordHash, fname, lname, courseID, yearOfStudy, pronouns, position) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

         // Check if the SQL query is valid
         if(!$stmt->execute([$email, $username, $hashed_password, $fname, $lname, $courseID, $yearOfStudy, $pronouns, $position])){
             header("location: login.php?error=BadSQLQuery");
             exit();
         }
 
         // return true if the user was created successfully
         return true;
    }

    


   
    

    // Check if the user exists
    protected function check_user_exists($username){ // username: string

        // prepare the SQL query
        $stmt = $this->connect()->prepare("SELECT * FROM user WHERE username = ? LIMIT 1");

        // Check if the SQL query is valid
        if(!$stmt->execute([$username])){
            header("location: login.php?error=BadSQLQuery");
            exit();
        }

        // return true if the user exists
        $result = $stmt->get_result(); 
        return $result->num_rows > 0;

    }

     // Get the user ID from username
     protected function get_id_username($username){

        //prepare the SQL query
        $stmt = $this->connect()->prepare("SELECT userID FROM user WHERE username = ?");

        // Check if the SQL query is valid
        if(!$stmt->execute([$username])){
            header("location: login.php?error=BadSQLQuery");
            exit();
        }

        $result = $stmt->get_result()->fetch_assoc()['userID'];
        return $result;
    }

    // Get column ($columnName) of user ($userID)
    protected function get_column_from_id($columnName, $userID) {
        // Get "safe" version of columnName
        $safeColumnName = $this->connect()->real_escape_string($columnName);

        // Prepare query
        $query = $this->connect()->prepare("SELECT $safeColumnName FROM user WHERE userID = ?");

        // Perform query
        if(!$query->execute([$userID])){
            header("location: settings.php?error=BadSQLQuery");
            exit();
        }

        // Return query result
        return $query->get_result()->fetch_row()[0];
    }

    // Check if the username and email are unique
    protected function check_unique_email_username($username, $email){ // username: string, email: string

        // prepare the SQL query
        $stmt = $this->connect()->prepare("SELECT * FROM user WHERE username = ? OR email = ? LIMIT 1");

        // Check if the SQL query is valid
        if(!$stmt->execute([$username, $email])){
            header("location: login.php?error=BadSQLQuery");
            exit();
        }

        // return true if the user exists
        $result = $stmt->get_result(); 
        return $result->num_rows > 0;

    }

    // Check the passwords match
    protected function compare_password($username, $password){ // username: string

        // prepare the SQL query
        $stmt = $this->connect()->prepare("SELECT passwordHash FROM user WHERE username = ? LIMIT 1");

        // Check if the SQL query is valid
        if(!$stmt->execute([$username])){
            header("location: login.php?error=BadSQLQuery");
            exit();
        }

        $result = $stmt->get_result();
        $passwordHash = $result->fetch_assoc()['passwordHash'];
        return password_verify($password, $passwordHash);

    }

   

    // Get the user ID from email
    protected function get_id_email($email){

        //prepare the SQL query
        $stmt = $this->connect()->prepare("SELECT userID FROM user WHERE email = ?");

        // Check if the SQL query is valid
        if(!$stmt->execute([$email])){
            header("location: login.php?error=BadSQLQuery");
            exit();
        }

        $result = $stmt->get_result()->fetch_assoc()['userID'];
        return $result;
    }


    // Gets all values for courses in the database
    protected function get_all_courses(){

       //prepare the SQL query
       $stmt = $this->connect()->prepare("SELECT * FROM course");

        // Check if the SQL query is valid
        if(!$stmt->execute()){
            header("location: login.php?error=BadSQLQuery");
            exit();
        }

        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $results;
    }

    // Gets the course name from the courseID
    protected function get_course_name($courseID){
        //prepare the SQL query
        $stmt = $this->connect()->prepare("SELECT name FROM course where courseID = ?");

        // Check if the SQL query is valid
        if(!$stmt->execute([$courseID])){
            header("location: login.php?error=BadSQLQuery");
            exit();
        }

        // return the course name
        return $stmt->get_result()->fetch_assoc()['name'];
    }


    // Create a recovery code
    protected function create_recovery_code($email){

        if ($this->get_id_email($email) != null){

            
            // Get the user ID from the email
            $userID = $this->get_id_email($email);

            //prepare the SQL query
            $stmt = $this->connect()->prepare("DELETE FROM recovery WHERE userID = ?");

            // delete any existing recovery codes from the database
            if(!$stmt->execute([$userID])){
                header("location: login.php?error=BadSQLQuery");
                exit();
            }


            // Get a random 6 digit number
            $token =  random_int(100000,999999);

            //prepare the SQL query
            $stmt = $this->connect()->prepare("INSERT INTO recovery (userID, token) VALUES (?, ?)");

            // Check if the SQL query is valid
            if(!$stmt->execute([$userID, $token])){
                header("location: login.php?error=BadSQLQuery");
                exit();
            }

            
            return $token;
        }

        return -1;

    }

    // Delete recovery code
    protected function delete_record($userID){
            
             //prepare the SQL query
            $stmt = $this->connect()->prepare("DELETE FROM recovery WHERE userID = ?");

            // delete corresponding record from the database
            if(!$stmt->execute([$userID])){
                header("location: login.php?error=BadSQLQuery");
                exit();
            }              
        
        return -1;
    }
    

    // Delete Account
    protected function delete_account_id($userID){

        //prepare the SQL query
        $stmt = $this->connect()->prepare(
        "DELETE FROM user
            WHERE userID = ?"
        );

        // Check if the SQL query is valid
        if(!$stmt->execute([$userID])){
            header("location: settings.php?error=BadSQLQuery");
            exit();
        }

        return true;
    }

    // Update password
    protected function update_password($hashed_password,$userID){

        // prepare the SQL query
        $stmt = $this->connect()->prepare("UPDATE user SET passwordHash = ? WHERE userID = ?");

        // Check if the SQL query is valid
        if(!$stmt->execute([$hashed_password,$userID])){
            header("location: login.php?error=BadSQLQuery");
            exit();
        }

        // return true if the password was updated successfully
        return true;
    }

    // Update bio
    protected function update_bio($bio,$userID){

        // prepare the SQL query
        $stmt = $this->connect()->prepare("UPDATE user SET description = ? WHERE userID = ?");

        // Check if the SQL query is valid
        if(!$stmt->execute([$bio,$userID])){
            header("location: login.php?error=BadSQLQuery");
            exit();
        }
        // return true if the bit was updated successfully
        return true;
    }

    // Update info
    protected function update_info($fname,$lname,$year,$pronoun,$userID){

        // prepare the SQL query
        $stmt = $this->connect()->prepare("UPDATE user SET fName = ?, lName = ?,yearOfStudy = ?, pronouns = ?  WHERE userID = ?");

        // Check if the SQL query is valid
        if(!$stmt->execute([$fname,$lname,$year,$pronoun,$userID])){
            header("location: login.php?error=BadSQLQuery");
            exit();
        }
        // return true if the info was updated successfully
        return true;
    }

    // Get recovery code
    protected function get_recovery_code($userID){

        // Get the user ID from the email
        $stmt = $this->connect()->prepare("SELECT token FROM recovery WHERE userID = ? LIMIT 1");

        // Check if the SQL query is valid
        if(!$stmt->execute([$userID])){
            header("location: login.php?error=BadSQLQuery");
            exit();
        }

        // Return the recovery code
        $result = $stmt->get_result()->fetch_assoc()['token'];
        return $result;
    }

 

    
}