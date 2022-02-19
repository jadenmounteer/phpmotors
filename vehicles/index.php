<?php
// This is the Vehicles Controller

// Include the database connection file
require_once '../library/connections.php';

// Include the "main" model
require_once '../model/main-model.php';

// Include the vehicles model
require_once '../model/vehicles-model.php';


// Get the array of classifications
$classifications = getClassifications();
/* This displays the results to the screen
var_dump($classifications);
	exit;
*/

// Build a navigation bar using the $classifications array

$navList = '<ul class="nav-list">';
$navList .= "<li class='nav-list-item'><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
 $navList .= "<li class='nav-list-item'><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';



/*** Build the classification drop down menu ***/

// Create a $classificationList variable to build a dynamic drop-down select list. 
$classificationList = '<label for="classificationId"> Choose a Car Classificartion*</label><br>';
$classificationList .= '<select class="dropdown-menu" id="classificationId" name="classificationId">';
// Loop through the classifications and display them as options.
// The classificationName must appear in the browser as an option to select, but 
// the classificationId must be the value of each option.
// This list element will be used in the "add vehicle" view to provide a list of 
// classifications that already exist in the database.
foreach ($classifications as $classification) {
    $classificationList .= '<option value="';
    $classificationList .= "$classification[classificationId]";
    $classificationList .= '"';
    $classificationList .= ">$classification[classificationName]</option>";
}
// Close the classification list
$classificationList .= '</select>';


/***  Testing ***/
//echo $navList;
//echo $classificationList;


// Watch for and capture name-value pairs for decision making.

// Contain control structures to deliver views (discussed below).

// Contain control structures to process requests to add new classifications to the carclassifications table and vehicles to the inventory table.

// The controller should return data check error messages to the view from which the data was sent.

// The controller should return success or failure messages to the view from which the data was sent as described below.


// // Check the content being requested
// // Filter out any malicious input
// // We check the POST object (input from forms) and
// // the GET object (input from links) to see if there 
// // is a "name - value pair (aka key - value pair) where the key 
// // is the word "action". If such a combination is found, the value is stored in the $action variable.
$action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_POST, 'action');
    }

// Deliver the view based off of the action
switch ($action) {
    case 'add-classification':
        // Filter and store the data
        $classificationName = filter_input(INPUT_POST, 'classificationName');

        // Check for missing data
        if(empty($classificationName)){
            //$message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-classification.php';
            exit; 
        }

        // Send the data to the model
        $newClassOutcome = newClassification($classificationName);

        // Check and report the result
        if($newClassOutcome === 1){
            //$message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            // Navigate back to the controller using a header() function and a no name - value pair
            header('Location: /phpmotors/vehicles'); // TODO: This might error out. I may need to get rid of one of the phpmotors
            exit;
        } else {
            $message = "<p>Error: unable to create new classification.</p>";
            include '../view/add-classification.php';
            exit;
        }

        break;

    case 'add-vehicle':
        // Filter and store the data
        $classificationId = filter_input(INPUT_POST, 'classificationId');
        $invMake = filter_input(INPUT_POST, 'invMake');
        $invModel = filter_input(INPUT_POST, 'invModel');
        $invDescription = filter_input(INPUT_POST, 'invDescription');
        $invImage = filter_input(INPUT_POST, 'invImage');
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
        $invPrice = filter_input(INPUT_POST, 'invPrice');
        $invStock = filter_input(INPUT_POST, 'invStock');
        $invColor = filter_input(INPUT_POST, 'invColor');

        // Check for missing data
        if(
            empty($classificationId) ||
            empty($invMake) ||
            empty($invModel) ||
            empty($invDescription) ||
            empty($invImage) ||
            empty($invThumbnail) ||
            empty($invPrice) ||
            empty($invStock) ||
            empty($invColor)
            
            ){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-vehicle.php';
            exit; 
        }

        // Send the data to the model
        $newVehicleOutcome = newVehicle($classificationId, $invMake, $invModel,
            $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor);
        
        // Check and report the result
        if($newVehicleOutcome === 1){
            $message = "<p>Success. $invMake $invModel has been added to inventory.</p>";
            include '../view/add-vehicle.php';
            exit;
        } else {
            $message = "<p>Error: unable to create new vehicle.</p>";
            include '../view/add-vehicle.php';
            exit;
        }
        
        break;

    default: 
        // if user typed in http://lvh.me:8088/phpmotors/vehicles/ bring them to the vehicle management page
        include '../view/vehicle-man.php'; 
        break;
}

?>