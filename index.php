<?php
// This is the main controller

// Get the database connection file
require_once './library/connections.php';
// Get the PHP Motors model for use as needed
require_once './model/main-model.php';


// Get the array of classifications
$classifications = getClassifications();
/* This displays the results to the screen
var_dump($classifications);
	exit;
*/

// Build a navigation bar using the $classifications array
$navList = '<ul class="nav-list">';
$navList .= "<li class='nav-list-item'><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
 $navList .= "<li class='nav-list-item'><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

//echo $navList;
//exit;

// Check the content being requested
// Filter out any malicious input
// We check the POST object (input from forms) and
// the GET object (input from links) to see if there 
// is a "name - value pair (aka key - value pair) where the key 
// is the word "action". If such a combination is found, the value is stored in the $action variable.
$action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_POST, 'action');
    }

// Deliver the view based off of the action
switch ($action) {
    case 'template':
        include 'view/template.php';
        break;
    default: 
        include 'view/home.php';
}

?>