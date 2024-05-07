<?php


include "../Database.class.php";
include "../Feedback.class.php";
include "../FeedbackView.class.php";

$LoginContr = new LoginContr();

class loginContr_UnitTesting
{
    private $LoginContr;

    public function __construct($LoginContr)
    {
        $this->LoginContr = $LoginContr;
    }



    public function test_force_login()
    {
        // make row data
        $userID = 0;
        $_SESSION['userID'] = $userID;

        // Invoke the method
        assert($this->LoginContr->force_login()); // Make sure to still test both logged in and out
    }


    public function test_check_login()
    {
        // make row data
        $userID = 0;
        $_SESSION['userID'] = $userID;

        // Invoke the method
        assert($this->LoginContr->check_login()); // Make sure to still test both logged in and out
    }



    public function test_user_sign_up()
    {
        // make row data
        $email = 'test@email.com';
        $username = 'utest';
        $hashed_password = 'passtest';
        $fname = 'ftest';
        $lname = 'ltest';
        $courseID = 1;
        $yearOfStudy = 1;
        $pronouns = 'he/him';
        $position = 'admin';

        // Invoke the method
        assert($this->LoginContr->sign_up($email, $username, $hashed_password, $fname, $lname, $courseID, $yearOfStudy, $pronouns, $position)); // STILL CHECK DB TO ENSURE DATA IS CORRECT

    }


    public function test_update_user_password()
    {
        // make row data
        $userID = 0;
        $new_password = 'newpass';

        // Invoke the method
        assert($this->LoginContr->update_user_password($userID, $new_password)); // STILL CHECK DB TO ENSURE DATA IS CORRECT
    }

    public function test_update_user_info()
    {
        // make row data
        $userID = 0;
        $email = 'test@email.com';
        $username = 'utest';
        $fname = 'ftest';
        $lname = 'ltest';
        $courseID = 1;
        $yearOfStudy = 1;
        $pronouns = 'he/him';
        $position = 'admin';
        
        // Invoke the method
        assert($this->LoginContr->update_user_info($userID, $email, $username, $fname, $lname, $courseID, $yearOfStudy, $pronouns, $position)); // STILL CHECK DB TO ENSURE DATA IS CORRECT

    }

    public function test_update_user_bio()
    {
        // make row data
        $userID = 0;
        $bio = 'test bio';

        // Invoke the method
        assert($this->LoginContr->update_user_bio($userID, $bio)); // STILL CHECK DB TO ENSURE DATA IS CORRECT
    }
    
}