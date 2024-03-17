<?php

class Database{

    protected static $dbhost = "localhost";
    protected static $dbuser = "root";
    protected static $dbpass = "";
    protected static $dbname = "feedtracdb";
    protected static $con;



    // establish connection to the database
    public static function connect()
    {
        self::$con = new mysqli(self::$dbhost, self::$dbuser, self::$dbpass, self::$dbname);
        
        if (self::$con->connect_error) {
			echo "Failed to connect to database: \n" . self::$con->connect_error;
		}

        return self::$con;
    }


    // Query the database
    public static function query($sql){
        return mysqli_query(self::$con, $sql);

        $stmt = self::connect()->prepare($sql);

        // Check if the SQL query is valid
        if(!$stmt->execute()){
            header("location: database.php?error=BadSQLQuery");
            exit();
        }

       $stmt = null;
    }

    // Check if user is logged in and redirect to login if not
    public static function check_login(){


        if(isset($_SESSION['userID'])){
            
            $result = self::query("SELECT * FROM user WHERE userID = '" . $_SESSION['userID'] . "' limit 1");
            if($result && mysqli_num_rows($result) > 0){
                $user_data = $result -> fetch_assoc();
                return $user_data;
            }
        }

        
        //redirect to login
        header("Location: login.php");
        die;
        
    }

    // Check if user is logged in and redirect to index if they are
    public static function force_logout(){
        if(isset($_SESSION['user_id'])){
            header("Location: index.php");
        }
    }
    
        
    

}