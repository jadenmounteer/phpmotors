<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css" media="screen">
    <title>PHP Motors | Home</title>
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
                <!-- The banner section -->
                <section class="banner-section">
                    <h1 class="content-title">Welcome to PHP Motors!</h1>
                    <div class="banner-description-div">
                        <h2 class="banner-section-title">DMC Delorean</h2>
                        <p class="banner-description-text">3 Cup holders</p>
                        <p class="banner-description-text">Superman doors</p>
                        <p class="banner-description-text">Fuzzy dice!</p>
                    </div>
                     <!-- The call to action top button -->
                     <div class="call-to-action-button-div call-to-action-top">
                        <button class="call-to-action-button call-to-action-button-top">Own Today</button>
                    </div>
                    <!-- The banner image -->
                    <div class="banner-img-div">
                        <img class="banner-img responsive-image" src="./images/vehicles/delorean-no-background.jpeg" alt="An image of a Delorean">
                    </div>
                    <!-- The call to action bottom button -->
                    <div class="call-to-action-button-div call-to-action-bottom">
                        <button class="call-to-action-button">Own Today</button>
                    </div>
                </section>

                <div class="content-grid">
                    <!-- The Reviews section -->
                    <section class="reviews-section">
                        <h1 class="content-title">DMC Delorean Reviews</h1>
                        <ul class="list-of-reviews">
                            <li class="review">"So fast its almost like traveling in time." (4/5)</li>
                            <li class="review">"Coolest ride on the road." (4/5)</li>
                            <li class="review">"I'm feeling Marty McFly!" (5/5)</li>
                            <li class="review">"The most futuristic ride of our day." (5/5)</li>
                            <li class="review">"80's livin and I love it!" (5/5)</li>
                        </ul>
                    </section>

                    <!-- Dolorean Upgrades section -->
                    <section class="upgrades-section">
                        <h1 class="content-title">Dolorean Upgrades</h1>
                        <div class="upgrades-grid">
                            <div class="upgrade-div">
                                <div class="upgrade-background">
                                <img class="upgrade-img" src="./images/upgrades/flux-cap.png" alt="Flux capacitor">
                                </div>
                                <a href="#">Flux capacitor</a>
                            </div>
                            <div class="upgrade-div">
                                <div class="upgrade-background">
                                <img class="upgrade-img" src="./images/upgrades/flame.jpg" alt="Flame decals">
                                </div>
                                <a href="#">Flame Decals</a>
                            </div>
                            <div class="upgrade-div">
                                <div class="upgrade-background">
                                <img class="upgrade-img" src="./images/upgrades/bumper_sticker.jpg" alt="Bumper stickers">
                                </div>
                                <a href="#">Bumper Stickers</a>
                            </div>
                            <div class="upgrade-div">
                                <div class="upgrade-background">
                                <img class="upgrade-img" src="./images/upgrades/hub-cap.jpg" alt="Hub Caps">
                                </div>
                                <a href="#">Hub Caps</a>
                            </div>
                        </div>
                    </section>
                </div>
                

        </main>

        <!-- Page footer -->
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?> 
        </footer>
    </div>
    
</body>
</html>