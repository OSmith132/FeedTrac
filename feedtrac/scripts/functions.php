<?php

// GENERAL ARRAYS AND FUNCTIONS: =================================================================================================

// Get the string representation of the urgency level
$get_urgency_string = array(
     "Low",         // => 0
     "Medium",      // => 1
     "High",        // => 2
     "Critical"     // => 3
 );

 // Get the string representation of the resolved status
 $get_resolved_string = array(
     "Unresolved",            // => 0
     "Resolved",              // => 1
     "Resolved and closed",   // => 2
     "Force closed"           // => 3
 );


// Shorten strings to the desired length and add "..." to the end
function shorten($string, $maxLength) {
     if (strlen($string) > $maxLength) {
          $string = substr($string, 0, $maxLength) . '...';
     }
     return $string;
}