<?php
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
    <title>Image Management | PHP Motors</title>
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
                <h1 class="content-title">Image Management</h1>
                <br>
                <p>Welcome to Image Management. Please select an option below.</p>

                <h2>Add New Vehicle Image</h2>

                <div class="form-div">
                    <?php
                    if (isset($message)) {
                    echo $message;
                    } ?>
                    <br>

                    <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
                    <label for="invItem">Vehicle</label>
                        <?php echo $prodSelect; ?>
                        <fieldset>
                            <label>Is this the main image for the vehicle?</label>
                            <label for="priYes" class="pImage">Yes</label>
                            <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                            <label for="priNo" class="pImage">No</label>
                            <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                        </fieldset>
                    <label>Upload Image:</label>
                    <input type="file" name="file1" class="choose-file-button">
                    <input type="submit" class="regbtn upload-button" value="Upload">
                    <input type="hidden" name="action" value="upload">
                    </form>
                </div>

                <hr>

                <h2>Existing Images</h2>
                <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
                <br>
                <?php
                if (isset($imageDisplay)) {
                echo $imageDisplay;
                } ?>

            </section>
        </main>

        <!-- Page footer -->
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?> 
        </footer>
    </div>
    
</body>
</html>

<?php unset($_SESSION['message']); ?>