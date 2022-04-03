<?php

/*** THE REVIEWS CONTROLLER ***/

// Create or access a session
session_start();

// Include the database connection file
require_once '../library/connections.php';

// Include the "main" model
require_once '../model/main-model.php';

// Include the vehicles model
require_once '../model/vehicles-model.php';

// Include the uploads model
require_once '../model/uploads-model.php';

// Include the reviews model
require_once '../model/reviews-model.php';

// Get the functions library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();

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

switch($action) {
    
    case 'add-new-review':
        // Filter and store the data
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        $screenName = trim(filter_input(INPUT_POST, 'screenName', FILTER_SANITIZE_STRING));


        // Check for missing data
        if(
            empty($reviewText) ||
            empty($invId) ||
            empty($clientId)
        ) {
            $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';
        }
        else {
            // Send the data to the model
            $newReviewOutcome = addNewReview($reviewText, $invId, $clientId, $screenName);

            // Check and report the result
            if($newReviewOutcome === 1) {
                $_SESSION['message'] = "<p>The review has been added</p>";
            } 
            else {
                $_SESSION['message'] = "<p>Error: unable to add review</p>";
            }
            
            // Get the current list of reviews from the model
            $listOfReviews = getReviewsByInvItem($invId);

            // Create the list of reviews
            $_SESSION['listOfReviews'] = buildListOfReviews($listOfReviews);

        }
        // Direct the user back to the vehicle detail page
        header("Location: /phpmotors/vehicles/?action=vehicleInformation&invId=$invId");

        
        
        exit;

        break;

    case 'edit-review':
        // Filter, sanitize, and store the second value being sent through the URL
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_STRING);

        // Get the review info
        $reviewInfo = getReview($reviewId);

        include '../view/edit-review.php';
        break;

    case 'update-review':
        // Filter and store the data
        $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        //$invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        //$clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

        // Check for missing data
        if(
            empty($reviewText)
        ) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            // Get the review info
            $reviewInfo = getReview($reviewId);
            include '../view/edit-review.php'; 
            exit;
        }

        // Send the data to the model
        $updateResult = updateReview($reviewId, $reviewText);

        // Check and report the result
        if($updateResult){
            $message = "<p>Success. The review was updated.</p>";
            $_SESSION['message'] = $message;
            include '../accounts/index.php'; 
            break;
        } else {
            $message = "<p>Error: unable to update review.</p>"; // TODO: change to appropriate view
            include '../view/edit-review.php';
        }
        exit;

        break;

    case 'confirm-delete-review':
        // Filter, sanitize, and store the second value being sent through the URL
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_STRING);

        $message = "<p>Deleting a review cannot be undone.</p><br>";

        // Get the review info
        $reviewInfo = getReview($reviewId);

        // Deliver the view
        include '../view/delete-review.php'; // TODO: Deliver the appropriate view

        break;

    case 'delete-review':
        // Filter and sanitize the data 
        $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));

        // Send the data to the model
        $deleteResult = deleteReview($reviewId);

         // Check and report the result
         if($deleteResult){
            $message = "<p>Success. The review was deleted.</p>";
            $_SESSION['message'] = $message;
            include '../accounts/index.php'; 
            exit;
        } else {
            $message = "<p>Error: The review could not be deleted.</p>";
            $_SESSION['message'] = $message;
            include '../view/delete-review.php'; 
            exit;
        }

        break;

    default:
        // Deliver the admin view if the client is logged in
        if(isset($_SESSION['loggedin'])){
            include '../view/admin.php'; 
        }
        else {
            // Deliver the php motors home view if the user is not logged in
            header('Location: /phpmotors/');
        }
        break;

        
}
?>