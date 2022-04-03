<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css" media="screen">
    <title>PHP Motors | Edit Review</title>
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
                <h1 class="content-title">Delete Review</h1>

                <div class="form-div">
                    <?php
                        // Show any messages that need to be displayed
                        if (isset($message)) {
                        echo $message;
                        }
                    ?>
                    <form action="/phpmotors/reviews/index.php" method="post">

                        <label for="reviewText">Review Text</label><br>
                        <textarea id="reviewText" name="reviewText" readonly><?php echo $reviewInfo[0]['reviewText'];?> </textarea><br><br>
                        <!-- Submit button -->
                        <input class="form-submit-button" type="submit" value="Delete">
                        <!-- Add the action name - value pair -->
                        <input type="hidden" name="action" value="delete-review">
                        <input type="hidden" name="reviewId" value="<?php if(isset($reviewInfo[0]['reviewId'])){ echo $reviewInfo[0]['reviewId'];} ?>">
                        <input type="hidden" name="invId" value="<?php if(isset($reviewInfo[0]['invId'])){ echo $reviewInfo[0]['invId'];} ?>">
                        <input type="hidden" name="clientId" value="<?php if(isset($reviewInfo[0]['clientId'])){ echo $reviewInfo[0]['clientId'];} ?>">
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