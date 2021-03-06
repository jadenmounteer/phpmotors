<?php
// This is the Accounts Controller

// Create or access a session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';
// Get the reviews model
require_once '../model/reviews-model.php';


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
$action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_POST, 'action');
    }

// Deliver the view based off of the action
switch ($action) {
    // Test password: pa55w@rdafg3gqwgF
    case 'register': 
        // Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING)); // FILTER_SANITIZE_STRING removes any HTML elements and leaves only text.
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING)); // We also use TRIM() to remove any whitespace
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        
        // Check if the email is valid
        $clientEmail = checkEmail($clientEmail);
        // Check if the password is valid
        $checkPassword = checkPassword($clientPassword);

        // Check for existing email
        $existingEmail = checkExistingEmail($clientEmail);

        // Deal with existing email during registration
        if($existingEmail){
            $message = '<p>The email address already exists. Do you want to login instead?</p>';
            include '../view/login.php';
            exit;
        }

        // Check for missing data
        // A 0 is still considered empty
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit; 
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the result
        if($regOutcome === 1){
            // Set a cookie so we remember the client's name
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            
            $_SESSION['message'] = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            //$message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            header('Location: /phpmotors/accounts/?action=login');
            //include '../view/login.php';
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;

    case 'login-page': // Called when the user clicks on the My Account link
        include '../view/login.php';
        break;

    case 'login':
        // Filter and store the data 
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        
        // Check if the email is valid
        $clientEmail = checkEmail($clientEmail);
        // Check if the password is valid
        $checkPassword = checkPassword($clientPassword);

        // Check for missing data
        // A 0 is still considered empty
        if(empty($clientEmail) || empty($clientPassword)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/login.php'; 
            //echo $message;
            exit; 
        }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if(!$hashCheck) {
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Create some variables for the client data
        $clientFirstname = $_SESSION['clientData']['clientFirstname'];
        $clientLastname = $_SESSION['clientData']['clientLastname'];
        $clientEmail = $_SESSION['clientData']['clientEmail'];
        $clientLevel = $_SESSION['clientData']['clientLevel'];
        // Send them to the admin view
        include '../view/admin.php';
        exit;        
        break;

    case 'logout':
        // Unset the session data
        unset($_SESSION['clientData']);
        // Destroy the session
        session_destroy ();
        // Return the client to the main phpmotors controller
        header('Location: /phpmotors/');
        exit;        
        break;


    /* * ********************************** 
    * Control structure delivers
    * the client-update view. 
    * Called when the user clicks on the 
    * update account link.
    * ********************************** */
    case 'updateAccountInfo':
        // Create some variables for the client data
        $clientFirstname = $_SESSION['clientData']['clientFirstname'];
        $clientLastname = $_SESSION['clientData']['clientLastname'];
        $clientEmail = $_SESSION['clientData']['clientEmail'];
        $clientLevel = $_SESSION['clientData']['clientLevel'];
        $clientInfo = $_SESSION['clientData']['clientInfo'];
        $clientId = $_SESSION['clientData']['clientId'];
        // Deliver the client update view
        include '../view/client-update.php';
        break;

    /* * ********************************** 
    * Control structure that handles
    * the account update process.
    * ********************************** */
    case 'updateInfo':
        // Filter and collect the inputs
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING)); // FILTER_SANITIZE_STRING removes any HTML elements and leaves only text.
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING)); // We also use TRIM() to remove any whitespace
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        
        // Check if the email is valid 
        $clientEmail = checkEmail($clientEmail);

        // Check if email address is different than the one in the session.
        $emailSameAsSession = $clientEmail = $_SESSION['clientData']['clientEmail'];

         // If yes, check that the new email address does not already
        // exist in the clients table (same as in the registration process)
        if (!$emailSameAsSession) {
            $existingEmail = checkExistingEmail($clientEmail);
            if($existingEmail){
                $message = '<p>The email address already exists.</p>';
                include '../view/client-update.php';
                exit;
            }
        }
        
        // Check for errors
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            // Return data to the client-update view for correction if errors are found.
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit; 
        }
        
        // Process the update using an appropriate function
        $updateResult = updateAccount($clientFirstname, $clientLastname, $clientEmail, $clientId);
        //echo $updateResult;
        //exit;

        // Set a success or failure message and store it in the session
        if($updateResult){
            $message = "<p>Success. $clientFirstname $clientLastnams's account was updated.</p>";
            $_SESSION['message'] = $message;
        } else {
            $message = "<p>Error: unable to update account.</p>";
            include '../view/client-update.php';
            exit;
        }

        // Query the client data from the database, based on the clientId
        $clientData = getClientById($clientId);

        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);

        // Store the array into the session
        $_SESSION['clientData'] = $clientData;

        // Create some variables for the client data
        $clientFirstname = $_SESSION['clientData']['clientFirstname'];
        $clientLastname = $_SESSION['clientData']['clientLastname'];
        $clientEmail = $_SESSION['clientData']['clientEmail'];

        // Deliver the "admin.php" view where the updated client information will be displayed along with the success
        // or failure message
        include '../view/client-update.php';

        break;

    
    /* * ********************************** 
    * Control structure that handles
    * the password change process.
    * ********************************** */
    case 'updatePassword':
        // Filter and collect the new password.
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        // Check that it meets the password requirements (the same as during registration).
        $checkPassword = checkPassword($clientPassword);

        // If there is an error, set an error message and return to the previous view to be fixed.
        if(empty($checkPassword)){
            $message = '<p>Error. Password does not match requirements.</p>';
            include '../view/client-update.php';
            exit; 
        }

        // If no error is found, the password must be hashed then sent to a function to be updated in the database.
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        
        // Determine the result of the update.
        $updateOutcome = updatePassword($hashedPassword, $clientId);

        // Set a success or failure message and store it in the session.
        if($updateOutcome === 1){
            $_SESSION['message'] = "<p>Your password has been changed.</p>";
        } else {
            $_SESSION['message'] = "<p>Error updating password.</p>";
        }

        // Deliver the "admin.php" view where the client information will be displayed along with the success or failure message.
        include '../view/admin.php';
        break;

        
    default: 
        // Create some variables for the client data
        $clientFirstname = $_SESSION['clientData']['clientFirstname'];
        $clientLastname = $_SESSION['clientData']['clientLastname'];
        $clientEmail = $_SESSION['clientData']['clientEmail'];
        $clientLevel = $_SESSION['clientData']['clientLevel'];
        $clientId = $_SESSION['clientData']['clientId'];

        // Get the reviews data
        $listOfClientReviews = getReviewsByClient($clientId);

        // Build the reviews display
        $listOfReviews = buildAccountListOfReviews($listOfClientReviews);

        include '../view/admin.php'; // Deliver the admin view
        //include '../view/500.php';
        break;
}

?>