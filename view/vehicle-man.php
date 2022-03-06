<?php
    // Check if the user is logged in and is an admin...
    checkIfAdminAndLoggedIn();

    // Display any messages from the session
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css" media="screen">
    <title>PHP Motors | Vehicle Management</title>
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
                <h1 class="content-title">Vehicle Management</h1>
                <div class="form-div">
                    <a title="add classification link" class="user-login-button light-font" href="/phpmotors/vehicles/index.php?action=add-classification">Add Classification</a>
                    <br>
                    <a title="add vehicle link" class="user-login-button light-font" href="/phpmotors/vehicles/index.php?action=add-vehicle">Add Vehicle</a>

                    <?php
                    
                    // Display a message if there is one
                    if(isset($message)) {
                        echo $message;
                    }
                    // Display a heading and directions and the classification list if there is one
                    
                    if (isset($classificationsList)) {
                        echo '<h2 class="vehicles-by-class-header">Vehicles by Classification</h2>';
                        echo '<p>Choose a classification to see those vehicles</p>';
                        echo $classificationsList;
                    }
                    ?>
                    <!-- If JavaScript is disabled, show a message -->
                    <noscript>
                        <p><strong>JavaScript must be enabled to use this page.</strong></p>
                    </noscript>
                    
                    <!-- The inventory will be displayed here by DOM manipulation -->
                    <div class="inventory-display-div">
                        <table id="inventoryDisplay"></table>
                    </div>
                
                </div>
            </section>
        </main>

        <!-- Page footer -->
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?> 
        </footer>
    </div>
    <!-- Link to the Inventory JavaScript file -->
    <script src="../js/inventory.js"></script>
</body>
</html>

<?php
    // Unset any messages
    unset($_SESSION['message']);
?>