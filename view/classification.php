<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css" media="screen">
    <title><?php echo $classificationName; ?> vehicles | PHP Motors, Inc.</title>
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
                <h1 class="content-title"><?php echo $classificationName; ?> vehicles</h1>
                <?php if(isset($message)) {
                    echo $message; }
                ?>
                <?php if(isset($vehicleDisplay)) {
                    echo $vehicleDisplay;
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