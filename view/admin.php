<?php
    // Test if the user is not logged in
    if(!isset($_SESSION['loggedin'])){
        // Use a header function to send the user to the main PHP Motors controller
        // for the home view to be delivered
        header('Location: /phpmotors/');
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css" media="screen">
    <title>PHP Motors | Admin</title>
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
                <!-- Since the user is logged in, display their data -->
                <?php
                    echo "
                    <h1 class='content-title'> $clientFirstname $clientLastname</h1>
                    <ul class='list-of-reviews'>
                        <li class='review'>First Name: $clientFirstname</li>
                        <li class='review'>Last Name: $clientLastname</li>
                        <li class='review'>Email: $clientEmail</li>
                    </ul>
                    ";

                    // If the client level is grater than 1, display a paragraph
                    // with a link that points to the vehicle controller
                    if($clientLevel > 1){
                        echo "<a class='message-link light-font' href='/phpmotors/vehicles/'>Vehicle Management</a>";
                    }
                    
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