<!DOCTYPE html>
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
                        <input type="text" id="invMake" name="invMake" required><br><br>

                        <label for="invModel">Model*</label><br>
                        <input type="text" id="invModel" name="invModel" required><br><br>

                        <label for="invDescription">Description*</label><br>
                        <input type="text" id="invDescription" name="invDescription" required><br><br>

                        <label for="invImage">Image Path*</label><br>
                        <input type="text" id="invImage" name="invImage" required value="www/phpmotors/images/no-image.png"><br><br>

                        <label for="invThumbnail">Thumbnail Path*</label><br>
                        <input type="text" id="invThumbnail" name="invThumbnail" required value="www/phpmotors/images/no-image.png"><br><br>

                        <label for="invPrice">Price*</label><br>
                        $<input type="number" id="invPrice" name="invPrice" required><br><br>

                        <label for="invStock">Stock*</label><br>
                        <input type="number" id="invStock" name="invStock" required><br><br>

                        <label for="invColor">Color*</label><br>
                        <input type="text" id="invColor" name="invColor" required><br><br>

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