<?php
// This is the Accounts Controller

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';


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
    case 'login':
        include '../view/login.php';
        break;
    case 'register':
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
        $clientLastname = filter_input(INPUT_POST, 'clientLastname');
        $clientEmail = filter_input(INPUT_POST, 'clientEmail');
        $clientPassword = filter_input(INPUT_POST, 'clientPassword');

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit; 
        }

        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);

        // Check and report the result
        if($regOutcome === 1){
            $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            include '../view/login.php';
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
    default: 
        include '../view/500.php';
        break;
}

?>