<?php

class LoginView extends Login
{
    private $userID;
    // Course ID not currently used but made available
    private $courseID;
    public $courseName;
    public $email;
    public $username;
    public $fName;
    public $lName;
    public $year;
    public $pronoun;
    public $description;
    public $position;

    public function __construct($userID){
        $this->userID = $userID;
        $this->courseID = $this->get_column_from_id("CourseID", $userID);
        $this->email = $this->get_column_from_id("email", $userID);
        $this->username = $this->get_column_from_id("username", $userID);
        $this->fName = $this->get_column_from_id("fName",$userID);
        $this->lName = $this->get_column_from_id("lName", $userID);
        $this->year = $this->get_column_from_id("YearOfStudy",$userID);
        $this->pronoun = $this->get_column_from_id("pronouns", $userID);
        $this->description = $this->get_column_from_id("description",$userID);
        $this->position = $this->get_column_from_id("position",$userID);
        $this->courseName = $this->get_course_name($this->courseID);
    }


}