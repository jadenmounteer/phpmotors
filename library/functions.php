<?php

/**
 * Checks if an email is valid.
 * Returns NULL if not. If valid, returns the email address.
 */
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

/**
 * Check the password for a minimum of 8 characters,
 * at least one 1 capital letter, at least 1 number and
 * at least 1 special character.
 * Returns 1 if the two match, or 0 if they don't.
 */ 
 function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
   }


/**
 * Checks the length of a given string.
 * Returns the string if the string is less than or equal to the max length.
 * Returns 0 if it is larger.
 * @param - The string to checl
 */
function checkLength($stringToCheck, $maxLength) {
    if (strlen($stringToCheck) <= $maxLength) {
        return $stringToCheck;
    }
    else {
        return 0;
    }
}

/**
 * Builds the navigation bar.
 * @param - An array of classifications
 * @return - A string variable holding the HTML navigation list
 */
function buildNavigationBar($classifications) {
    $navList = '<ul class="nav-list">';
    $navList .= "<li class='nav-list-item'><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li class='nav-list-item'><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';

    return $navList;
}

/** 
 * Checks if the user a user is logged in. Then checks if 
 * they are an admin. If no to either, they are redirected to the home page.
 */
function checkIfAdminAndLoggedIn() {
    if ($_SESSION['clientData']['clientLevel'] < 2) {
        header('location: /phpmotors/');
        exit;
       }
}

// Build the classifications select list 
function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 
    foreach ($classifications as $classification) { 
     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
   }

// Builds a display of vehicles within an unordered list
function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
     $dv .= '<li>';
     $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
     $dv .= '<hr>';
     $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
     $dv .= "<span>$vehicle[invPrice]</span>";
     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
   }



?>