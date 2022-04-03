<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css" media="screen">
    <title><?php echo "$invMake $invModel"; ?> | PHP Motors, Inc.</title>
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
                <h1 class="content-title"><?php echo "$invMake $invModel"; ?> </h1>
                <?php if(isset($message)) {
                    echo $message; }

                    // Display any messages from the session
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                    }
                ?>

                

                <div class="thumbnail-grid">
                    <!-- Image thumbnail for larger screens -->
                    <div class="disapear-on-smaller-screen img-thumbnail-for-larger-screen">
                        <?php if(isset($thumbnailImageDisplay)) {
                            echo $thumbnailImageDisplay;
                        } ?>
                    </div>
                    
                    <?php if(isset($vehicleInformationDisplay)) {
                        echo $vehicleInformationDisplay;
                    } ?>
                </div>
                

                <!-- Image thumbnail display for mobile -->
                <div class="disapear-on-larger-screen">
                    <h2>Vehicle Thumbnails</h2>
                    <?php if(isset($thumbnailImageDisplay)) {
                        echo $thumbnailImageDisplay;
                    } ?>
                </div>
            
            <!-- The customer reviews section -->
            <h2 class="content-title">Customer Reviews</h2>

            <!-- Check if the user is logged in. Deliver the appropriate content -->
            <?php
                if($_SESSION['loggedin']) {
                    // The form for entering a review
                    echo '<h3 class="content-title">Review the ' . $invMake . " " . $invModel . ' </h3>';
                    echo buildReviewForm($invId);
                }
                else {
                    // Since the user is not logged in, we provide different content
                    echo '<a class="user-login-button" id="login-to-ad-review-link" title="Login to add a review" href="/phpmotors/accounts/index.php?action=login-page">Login to add a review</a>';
                }

                // Show the list of reviews
                echo $_SESSION['listOfReviews'];
            ?>

                

            </section>
        </main>

        <!-- Page footer -->
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?> 
        </footer>
    </div>
    
</body>
</html>

<?php
    // Unset any messages
    unset($_SESSION['message']);
?>