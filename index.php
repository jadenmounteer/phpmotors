<?php
// This is the main controller

// Create or access a session
session_start();

// Get the database connection file
require_once './library/connections.php';
// Get the PHP Motors model for use as needed
require_once './model/main-model.php';
// Get the functions library
require_once './library/functions.php';


// Get the array of classifications
$classifications = getClassifications();
/* This displays the results to the screen
var_dump($classifications);
	exit;
*/

// Build a navigation bar using the $classifications array
$navList = buildNavigationBar($classifications);

//echo $navList;
//exit;

// Check the content being requested
// Filter out any malicious input
// We check the POST object (input from forms) and
// the GET object (input from links) to see if there 
// is a "name - value pair (aka key - value pair) where the key 
// is the word "action". If such a combination is found, the value is stored in the $action variable.
$action = trim(filter_input(INPUT_GET, 'action',));
    if ($action == NULL) {
        $action = filter_input(INPUT_POST, 'action');
    }

// Check if the firstname cookie exists, get its value (THIS HAS BEEN REPLACED BY THE SESSION MESSAGE)
/*
if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}
*/

// Deliver the view based off of the action
switch ($action) {
    case 'template':
        include 'view/template.php';
        break;
    default: 
        include 'view/home.php';
}

?>