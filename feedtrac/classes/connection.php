<?php

class database{

    protected $dbhost = "localhost";
    protected $dbuser = "root";
    protected $dbpass = "";
    protected $dbname = "feedtracdb";
    protected $con;

    // establish connection to the database
    function __construct()
    {
        $this -> con = new mysqli($this -> dbhost, $this -> dbuser, $this -> dbpass, $this -> dbname);
        
        if ($this->con->connect_error) {
			echo "Failed to connect to database: \n" . $this->con->connect_error;
		}
    }

    // Query the database
    public function query($sql){
        return mysqli_query($this -> con, $sql);
    }

    // Check if user is logged in and redirect to login if not
    public function check_login(){


        if(isset($_SESSION['userID'])){
            
            $result = $this -> query("SELECT * FROM user WHERE userID = '" . $_SESSION['userID'] . "' limit 1");
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
    function force_logout(){
        if(isset($_SESSION['user_id'])){
            header("Location: index.php");
        }
    }
    
        
    

}