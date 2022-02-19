<!DOCTYPE html>
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