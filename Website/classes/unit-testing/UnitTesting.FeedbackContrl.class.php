<?php

include "../Database.class.php";
include "../Feedback.class.php";
include "../FeedbackContr.class.php";


$feedbackContr = new FeedbackView(1);

class FeedbackContr_UnitTesting
{
    private $feedbackContr;

    public function __construct($feedbackContr)
    {
        $this->feedbackContr = $feedbackContr;
    }

    public function test_new_feedback()
    {
        $roomID = 1;
        $urgency = 1;
        $resolved = 0;
        $closed = 0;
        $title = 'Test Title';
        $text = 'Test Text';

        // Assert that the feedback was created successfully (STILL NEED TO CHECK DB TO ENSURE DATA IS CORRECT)
        assert($this->feedbackContr->new_feedback($roomID, $urgency, $resolved, $closed, $title, $text));
    }
    

    public function test_new_comment()
    {
        $userID = 1;
        $feedbackID = 1;
        $text = 'Test Comment';
        $ratingPoints = 5;


        // Assert that the comment was created successfully (STILL NEED TO CHECK DB TO ENSURE DATA IS CORRECT)
        assert($this->feedbackContr->new_comment($userID, $feedbackID, $text, $ratingPoints));
    }


    public function test_set_feedback()
    {
        $feedbackID = 1;
        $roomID = 1;
        $date = '2024-04-01';
        $urgency = 1;
        $resolved = 0;
        $closed = 0;
        $title = 'Test Title';
        $text = 'Test Text';


        // Assert that the feedback was created successfully (STILL NEED TO CHECK DB TO ENSURE DATA IS CORRECT)
        assert($this->feedbackContr->set_feedback($feedbackID, $roomID, $date, $urgency, $resolved, $closed, $title, $text));
    }


    public function test_set_rating()
    {
        $positiveRating = 1;
        $feedbackID = 1;
        $ratingPoints = 5;

        // Assert that the rating was set successfully (STILL NEED TO CHECK DB TO ENSURE DATA IS CORRECT)
        assert($this->feedbackContr->set_rating($positiveRating, $feedbackID, $ratingPoints));
    }


    public function test_set_feedback_status()
    {
        $feedbackID = 1;
        $newStatus = 1;

        // Assert that the feedback status was set successfully (STILL NEED TO CHECK DB TO ENSURE DATA IS CORRECT)
        assert($this->feedbackContr->set_feedback_status($feedbackID, $newStatus));
    }   


    public function test_set_feedback_resolved()
    {
        $feedbackID = 1;
        $newResolved = 1;

        // Assert that the feedback status was set successfully (STILL NEED TO CHECK DB TO ENSURE DATA IS CORRECT)
        assert($this->feedbackContr->set_feedback_resolved($feedbackID, $newResolved));
    }


    public function testModifyDate()
    {
        $date = '2021-04-01';
        $newDate = '2021-04-02';

        // Assert that the date was modified successfully (STILL NEED TO CHECK DB TO ENSURE DATA IS CORRECT)
        assert($this->feedbackContr->modify_date($date, $newDate));
    }



}