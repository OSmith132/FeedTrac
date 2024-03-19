<?php 

class Login extends Database {



    // Check if user is logged in and redirect to login if not
    protected function get_user_data(){ //

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

  
    protected function check_user_exists($username){ // username: string

        // prepare the SQL query
        $stmt = $this->connect()->prepare("SELECT * FROM user WHERE username = ? LIMIT 1");

        // Check if the SQL query is valid
        if(!$stmt->execute([$username])){
            header("location: profile.php?error=BadSQLQuery");
            exit();
        }

        // return true if the user exists
        $result = $stmt->get_result(); 
        return $result->num_rows > 0;

    }


    protected function compare_password($username, $password){ // username: string

        // prepare the SQL query
        $stmt = $this->connect()->prepare("SELECT passwordHash FROM user WHERE username = ? LIMIT 1");

        // Check if the SQL query is valid
        if(!$stmt->execute([$username])){
            header("location: profile.php?error=BadSQLQuery");
            exit();
        }

        $result = $stmt->get_result();
        $passwordHash = $result->fetch_assoc()['passwordHash'];
        return password_verify($password, $passwordHash);

    }


    protected function get_id($username){

        //prepare the SQL query
        $stmt = $this->connect()->prepare('SELECT userID FROM user WHERE username = ?');

        // Check if the SQL query is valid
        if(!$stmt->execute([$username])){
            header("location: profile.php?error=BadSQLQuery");
            exit();
        }

        $result = $stmt->get_result()->fetch_assoc()['userID'];
        return $result;
    }
}