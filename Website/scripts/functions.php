<?php

// GENERAL ARRAYS AND FUNCTIONS: =================================================================================================

// Get the string representation of the urgency level
$get_urgency_string = array(
    "<p class='urgency-tag urgency-tag-low'>Low</p>",          // => 0
    "<p class='urgency-tag urgency-tag-medium'>Medium</p>",    // => 1
    "<p class='urgency-tag urgency-tag-high'>High</p>",        // => 2
    "<p class='urgency-tag urgency-tag-critical'>Critical</p>" // => 3
);

// Get the string representation of the resolved status
$get_resolved_string = array(
    "<p class='tag tag-unresolved'>Unresolved</p>", // => 0
    "<p class='tag tag-resolved'>Resolved</p>",     // => 1
);

// Get the string representation of the closed status
$get_closed_string = array(
    "<p class='tag tag-open'>Open</p>",     // => 0
    "<p class='tag tag-closed'>Closed</p>", // => 1
);


// Shorten strings to the desired length and add "..." to the end
function shorten($string, $maxLength) {
     if (strlen($string) > $maxLength) {
          $string = substr($string, 0, $maxLength) . '...';
     }
     return $string;
}

