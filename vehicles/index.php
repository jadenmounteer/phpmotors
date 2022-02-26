<?php
// This is the Vehicles Controller

// Create or access a session
session_start();

// Include the database connection file
require_once '../library/connections.php';

// Include the "main" model
require_once '../model/main-model.php';

// Include the vehicles model
require_once '../model/vehicles-model.php';

// Get the functions library
require_once '../library/functions.php';



// Get the array of classifications
$classifications = getClassifications();
/* This displays the results to the screen
var_dump($classifications);
	exit;
*/

// Build a navigation bar using the $classifications array
$navList = buildNavigationBar($classifications);

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
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));

        // Check the length of the classification name
        $classificationName = checkLength($classificationName, 30);

        // Check for missing data
        if(empty($classificationName)){
            $message = '<p>Please provide information for all empty form fields.</p>';
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
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));

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