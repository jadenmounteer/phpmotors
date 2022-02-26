<?php
// Check if the user is logged in and is an admin...
checkIfAdminAndLoggedIn();

// Create a $classificationList variable to build a dynamic drop-down select list. 
$classificationList = '<label for="classificationId"> Choose a Car Classificartion*</label><br>';
$classificationList .= '<select class="dropdown-menu" id="classificationId" name="classificationId">';
// Loop through the classifications and display them as options.
// The classificationName must appear in the browser as an option to select, but 
// the classificationId must be the value of each option.
// This list element will be used in the "add vehicle" view to provide a list of 
// classifications that already exist in the database.
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";

    // Make the dropdown sticky
    if(isset($classificationId)) {
        if($classification['classificationId'] === $classificationId) {
            $classificationList .= ' selected ';
        }
    }
    $classificationList .= ">$classification[classificationName]</option>";

}
// Close the classification list
$classificationList .= '</select>';

// Make the form's text area sticky
$text = "";
if(isset($_POST['invDescription']) && $_POST['invDescription'] != "") {
    $text= $_POST['invDescription'];
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css" media="screen">
    <title>PHP Motors | Add Vehicle</title>
</head>
<body>
    <!-- The content section that hovers above the background -->
    <div class="content">
        <header>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?> 
        </header>
        
         <!-- The nav section -->
         <nav>
            <?php 
                //require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/navigation.php';
                echo $navList;
            ?> 
        </nav>

        <!-- The main content of the page -->
        <main>
            <!-- The content title -->
            <section class="main-content-section">
                <h1 class="content-title">Add Vehicle</h1>
                <div class="form-div">
                    <?php
                        // Show any messages that need to be displayed
                        if (isset($message)) {
                        echo $message;
                        }
                    ?>
                    <form action="/phpmotors/vehicles/index.php" method="post">
                        <!-- The select drop down menu -->
                        <br>
                        <?php
                            echo $classificationList;
                        ?>
                        <br><br>
                        
                        <label for="invMake">Make*</label><br>
                        <input type="text" id="invMake" name="invMake" required <?php if(isset($invMake)){echo "value='$invMake'";}  ?>><br><br>

                        <label for="invModel">Model*</label><br>
                        <input type="text" id="invModel" name="invModel" required <?php if(isset($invModel)){echo "value='$invModel'";}  ?>><br><br>

                        <label for="invDescription">Description*</label><br>
                        <textarea id="invDescription" name="invDescription" required><?php echo $text;?> </textarea><br><br>

                        <label for="invImage">Image Path*</label><br>
                        <input type="text" id="invImage" name="invImage" required <?php if(isset($invImage)){echo "value='$invImage'";}else{"value='www/phpmotors/images/no-image.png'";}  ?>><br><br>

                        <label for="invThumbnail">Thumbnail Path*</label><br>
                        <input type="text" id="invThumbnail" name="invThumbnail" required  <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}else{"value='www/phpmotors/images/no-image.png'";}  ?>><br><br>

                        <label for="invPrice">Price*</label><br>
                        $<input type="number"  step="0.01" id="invPrice" name="invPrice" required <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?>><br><br>

                        <label for="invStock">Stock*</label><br>
                        <input type="number" id="invStock" name="invStock" required <?php if(isset($invStock)){echo "value='$invStock'";}  ?>><br><br>

                        <label for="invColor">Color*</label><br>
                        <input type="text" id="invColor" name="invColor" required <?php if(isset($invColor)){echo "value='$invColor'";}  ?>><br><br>

                        <!-- Submit button -->
                        <input class="form-submit-button" type="submit" value="Add Vehicle">
                        <!-- Add the action name - value pair -->
                        <input type="hidden" name="action" value="add-vehicle">
                    </form> 
                </div>
            </section>
        </main>

        <!-- Page footer -->
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?> 
        </footer>
    </div>
    
</body>
</html>