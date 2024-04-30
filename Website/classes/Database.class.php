<?php

class Database{

    protected $dbhost = "localhost";
    protected $dbuser = "root";
    protected $dbpass = "";
    protected $dbname = "feedtracdb";
    protected $con;



    // establish connection to the database
    protected function connect()
    {
        $this->con = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        
        if ($this->con->connect_error) {
			echo "Failed to connect to database: \n" . $this->con->connect_error;
		}

        return $this->con;
    }


    // Query the database
    protected function query($sql){ // THIS TAKES A STRING NOT A PREPARED STATEMENT
        
        $stmt = $this->connect()->prepare($sql);

        // Check if the SQL query is valid
        if(!$stmt->execute()){
            header("location: database.php?error=BadSQLQuery");
            exit();
        }

        return $stmt->get_result();


    }

    // Check if any input is empty
    protected function empty_input_check(...$inputs){

        // Check if any input is empty
        foreach ($inputs as $input){
            if (empty($input)){
                return true;
            }
        }

        // If no imput is empty, return false
        return false;
    }
    
    
        
    

}