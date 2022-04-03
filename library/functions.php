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
     $dv .= "<a href='/phpmotors/vehicles/?action=vehicleInformation&invId=".urlencode($vehicle['invId'])."'><img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
     $dv .= '<hr>';
     $dv .= "<a href='/phpmotors/vehicles/?action=vehicleInformation&invId=".urlencode($vehicle['invId'])."'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
     $dv .= "<span>$vehicle[invPrice]</span>";
     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
   }

// Takes the specific vehicle's information and wraps it up in HTML to deliver to the view
function buildVehicleInformationDisplay(
    $invMake, 
    $invModel, 
    $invPrice, 
    $invDescription, 
    $invImage, 
    $invColor, 
    $invStock) {
        $dv = '<div class="vehicle-information-div">';
        $dv .= '<div class="vehicle-info-left-col">';
        $dv .= "<div class='detail-img-div'> <img class='responsive-image detail-img' src='$invImage' alt='An image of $invMake $invModel on phpmotors.com'> </div>";
        $dv .= "<p>Price: $$invPrice</p>";
        $dv .= '</div>'; // Closing vehicle info left col div
        $dv .= '<div class="vehicle-info-right-col">';
        $dv .= "<h2>$invMake $invModel Details</h2>";
        $dv .= "<p class='description-paragraph'>$invDescription</p>";
        $dv .= "<p>Color: $invColor</p>";
        $dv .= "<p class='description-paragraph'># in Stock: $invStock</p>";
        $dv .= '</div>'; // Closing vehicle info right col
        $dv .= '</div>'; // closing vehicle information div


        return $dv;
}



/* * ********************************
*  Functions for working with images
* ********************************* */

// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    // Look for the location of the period in the name
    $i = strrpos($image, '.');
    // Get the image's name
    $image_name = substr($image, 0, $i);
    // Get the file extension
    $ext = substr($image, $i);
    // Add the extension to the end of the file
    $image = $image_name . '-tn' . $ext;
    return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
     $id .= '<li>';
     $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
     $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
     $id .= '</li>';
   }
    $id .= '</ul>';
    return $id;
}

// Build the vehicles select list
function buildVehiclesSelect($vehicles) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
     $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
     // Gets the actual file name
     $filename = $_FILES[$name]['name'];
     if (empty($filename)) {
      return;
     }
    // Get the file from the temp folder on the server
    $source = $_FILES[$name]['tmp_name'];
    // Sets the new path - images folder in this directory
    $target = $image_dir_path . '/' . $filename;
    // Moves the file to the target folder
    move_uploaded_file($source, $target);
    // Send file for further processing
    processImage($image_dir_path, $filename);
    // Sets the path for the image for Database storage
    $filepath = $image_dir . '/' . $filename;
    // Returns the path where the file is stored
    return $filepath;
    }
}

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
   
    // Set up the image path
    $image_path = $dir . $filename;
   
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
   
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
   
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
   
    // Set up the function names
    switch ($image_type) {
    case IMAGETYPE_JPEG:
     $image_from_file = 'imagecreatefromjpeg';
     $image_to_file = 'imagejpeg';
    break;
    case IMAGETYPE_GIF:
     $image_from_file = 'imagecreatefromgif';
     $image_to_file = 'imagegif';
    break;
    case IMAGETYPE_PNG:
     $image_from_file = 'imagecreatefrompng';
     $image_to_file = 'imagepng';
    break;
    default:
     return;
   } // ends the swith
   
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
   
    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
   
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
   
     // Calculate height and width for the new image
     $ratio = max($width_ratio, $height_ratio);
     $new_height = round($old_height / $ratio);
     $new_width = round($old_width / $ratio);
   
     // Create the new image
     $new_image = imagecreatetruecolor($new_width, $new_height);
   
     // Set transparency according to image type
     if ($image_type == IMAGETYPE_GIF) {
      $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
      imagecolortransparent($new_image, $alpha);
     }
   
     if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
      imagealphablending($new_image, false);
      imagesavealpha($new_image, true);
     }
   
     // Copy old image to new image - this resizes the image
     $new_x = 0;
     $new_y = 0;
     $old_x = 0;
     $old_y = 0;
     imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
   
     // Write the new image to a new file
     $image_to_file($new_image, $new_image_path);
     // Free any memory associated with the new image
     imagedestroy($new_image);
     } else {
     // Write the old image to a new file
     $image_to_file($old_image, $new_image_path);
     }
     // Free any memory associated with the old image
     imagedestroy($old_image);
} // ends resizeImage function


// Build the display to show thumbnail images
function buildThumbnailImageDisplay($imageArray) {
    $id = '<ul class="thumbnail-image-display">';
    foreach ($imageArray as $image) {
     $id .= '<li>';
     $id .= "<img src='$image[imgPath]' alt='A thumbnail image on PHP Motors.com'>";
     $id .= '</li>';
   }
    $id .= '</ul>';
    return $id;
}


// Build the review form
function buildReviewForm($invId) {
    // Get the screen name
    $clientFirstname = $_SESSION['clientData']['clientFirstname'];
    $clientLastname = $_SESSION['clientData']['clientLastname'];
    $clientId = $_SESSION['clientData']['clientId'];
    $firstInitialOfFirstName = $clientFirstname[0];
    $screenName = $firstInitialOfFirstName . $clientLastname;

    // Create the form
    $reviewForm = "
        <div class='form-div' id='review-form-div'>
        <form class='review-form' action='../reviews/index.php' method='post'>
            <label for='screenName'>Screen Name:</lable><br>
            <input type='text' id='screenName' name='screenName' readonly value='$screenName'><br>
            <label for='reviewText'>Review:</label><br>
            <textarea id='reviewText' name='reviewText' required></textarea><br>
            <input class='form-submit-button' type='submit' value='Submit Review'>
            <input type='hidden' name='action' value='add-new-review'>
            <input type='hidden' name='invId' value='$invId'>
            <input type='hidden' name='clientId' value='$clientId'>
        </form>
        </div>
        ";
    
    return $reviewForm;
}

// Build the list of reviews for a vehicle
function buildListOfReviews($listOfReviews) {
    $reviewsDisplay;
    // Check if the list of reviews is empty
    if(sizeOf($listOfReviews) < 1) {
        $reviewsDisplay = "<p>Be the first to leave a review.</p>";
    }
    else {
        $reviewsDisplay =  '<ul class="reviews-display">';
        foreach ($listOfReviews as $review) {
            // Format the date
            $formattedTimestamp = formatTimestamp($review['reviewDate']);
            // Add to the view
            $reviewsDisplay .= 
                "
                <li class='review'>
                <p class='review-info'>$review[screenName] wrote on $formattedTimestamp<p>
                <p class='review-text'>$review[reviewText]</p>
                </li>
                ";

        }
        $reviewsDisplay .= '</ul>'; 
       
    }
    return $reviewsDisplay;

}

// Format a timestamp
function formatTimestamp($timestamp) {
    $unixTimestamp = strtotime($timestamp); // Formats the date to a unix timestamp
    return date("j \of M, Y", $unixTimestamp);
}

// Build the account reviews display
// This is where the user can edit or delete their reviews
function buildAccountListOfReviews($listOfClientReviews) {
    $reviewsDisplay;
    if(sizeOf($listOfClientReviews) < 1) {
        $reviewsDisplay = "<p>You do not have any reviews</p>";
    }
    else {
        $reviewsDisplay = '<ul class="reviews-display">';
        foreach($listOfClientReviews as $review) {
            // Format the date
            $formattedTimestamp = formatTimestamp($review['reviewDate']);
            $reviewsDisplay .= 
            "
            <li class='review'>
                <p class='review-text'>$review[reviewText] <i>(Reviewed on $formattedTimestamp)</i> </p>
                <a class='review-button' alt='Edit button' href='/phpmotors/reviews/index.php?action=edit-review&reviewId=".urlencode($review['reviewId'])."'>Edit</a>
                <a class='review-button' alt='Delete button' href='/phpmotors/reviews/index.php?action=confirm-delete-review&reviewId=".urlencode($review['reviewId'])."'>Delete</a>
            </li>
            ";
        }
        $reviewsDisplay .= '</ul>';
    }

    return $reviewsDisplay;
}




?>