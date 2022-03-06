<?php
// Check if the user is logged in and is an admin...
checkIfAdminAndLoggedIn();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css" media="screen">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	 echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Delete $invMake $invModel"; }?> | PHP Motors</title>
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
                <h1 class="content-title"><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
                    echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
                elseif(isset($invMake) && isset($invModel)) { 
                    echo "Delete $invMake $invModel"; }?></h1>
                    <?php
                        // Show any messages that need to be displayed
                        if (isset($message)) {
                        echo $message;
                        }
                    ?>
                <div class="form-div">
                    
                    <form action="/phpmotors/vehicles/index.php" method="post">
                        <!-- The select drop down menu -->
                        <br>
                        <?php
                            echo $classificationList;
                        ?>
                        <br><br>
                        
                        <label for="invMake">Make*</label><br>
                        <input type="text" id="invMake" name="invMake" readonly <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>><br><br>

                        <label for="invModel">Model*</label><br>
                        <input type="text" id="invModel" name="invModel" readonly <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>><br><br>

                        <label for="invDescription">Description*</label><br>
                        <textarea id="invDescription" name="invDescription" readonly><?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea><br><br>

                        <!-- Submit button -->
                        <input class="form-submit-button" type="submit" value="Delete Vehicle">
                        <!-- Add the action name - value pair -->
                        <input type="hidden" name="action" value="deleteVehicle">
                        <!-- A second hidden input to store the primary key value for the item being updated -->
                        <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} ?>">
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