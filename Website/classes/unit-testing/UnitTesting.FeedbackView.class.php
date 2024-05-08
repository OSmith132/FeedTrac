<?php


// Include statements may need to be uncommented depending where testing is being executed
// include "../Database.class.php";
// include "../Feedback.class.php";
// include "../FeedbackView.class.php";

class FeedbackView_UnitTesting extends FeedbackView
{


    public function test_row_passes_filters()
    {

        // Get the current timestamp
        date_default_timezone_set('UTC');
        $date = time();

        // Get the timestamp for 30 mins ago
        $date = date('Y-m-d H:i:s', $date - (30 * 60));

        // make row data
        $feedbackRow = array(
            'feedbackID' => 1,
            'userID' => 1,
            'feedback' => 'This is a test feedback',
            'rating' => 5,
            'resolved' => 1,
            'closed' => 0,
            'urgency' => 1,
            'date' => $date
        );
        $resolved = 0;  // Resolved
        $closed = 0;    // Open
        $urgency = 1;   // Medium
        $timeframe = 0; // 1 hour

        // Invoke the method
        assert($this->row_passes_filters($feedbackRow, $resolved, $closed, $urgency, $timeframe));
    }


    public function test_get_inbox_feedback()
    {
        $dateTime = '2021-01-01 00:00:00';

        // Invoke the method
        assert($this->get_inbox_feedback($dateTime));// STILL CHECK DB TO ENSURE DATA IS CORRECT
    }

    public function test_get_user_info()
    {
        $feedbackID = 1;

        // Invoke the method
        assert($this->get_user_info($feedbackID));// STILL CHECK DB TO ENSURE DATA IS CORRECT
    }

    public function test_search_feedback()
    {
        $searchTerm = '';

        // Invoke the method
        assert($this->search_feedback($searchTerm));// STILL CHECK DB TO ENSURE DATA IS CORRECT
    }



}