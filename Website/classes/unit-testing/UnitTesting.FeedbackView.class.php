<?php

include "../Database.class.php";
include "../Feedback.class.php";
include "../FeedbackView.class.php";

$feedbackView = new FeedbackView(1);

class FeedbackView_UnitTesting
{
    private $feedbackView;

    public function __construct($feedbackView)
    {
        $this->feedbackView = $feedbackView;
    }
    
    public function test_row_passes_filters()
    {

        // make row data
        $feedbackRow = array(
            'feedbackID' => 1,
            'userID' => 1,
            'feedback' => 'This is a test feedback',
            'rating' => 5,
            'resolved' => 1,
            'closed' => 0,
            'urgency' => 1,
            'timeframe' => '2021-01-01 00:00:00'
        );
        $resolved = 0;
        $closed = 0;
        $urgency = 1;
        $timeframe = '2021-01-01 00:00:00';

        // Invoke the method
        assert($this->feedbackView->row_passes_filters($feedbackRow, $resolved, $closed, $urgency, $timeframe));// STILL CHECK DB TO ENSURE DATA IS CORRECT
    }


    public function test_get_inbox_feedback()
    {
        $dateTime = '2021-01-01 00:00:00';

        // Invoke the method
        assert($this->feedbackView->get_inbox_feedback($dateTime));// STILL CHECK DB TO ENSURE DATA IS CORRECT
    }

    public function test_get_user_info()
    {
        $feedbackID = 1;

        // Invoke the method
        assert($this->feedbackView->get_user_info($feedbackID));// STILL CHECK DB TO ENSURE DATA IS CORRECT
    }

    public function test_search_feedback()
    {
        $searchTerm = '';

        // Invoke the method
        assert($this->feedbackView->search_feedback($searchTerm));// STILL CHECK DB TO ENSURE DATA IS CORRECT
    }



}