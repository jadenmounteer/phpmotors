<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css" media="screen">
    <title>PHP Motors | Registration</title>
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
                <h1 class="content-title">Register</h1>
                <!-- Prompt the user to register -->
                <div class="form-div">
                <?php
                    // Show any messages that need to be displayed
                    if (isset($message)) {
                    echo $message;
                    }
                ?>
                    <form action="/phpmotors/accounts/index.php" method="post">
                        <label for="clientFirstname">First Name <strong>(Required)</strong></label><br>
                        <input type="text" id="firstname" name="clientFirstname" required><br>
                        <label for="clientLastname">Last Name <strong>(Required)</strong></label><br>
                        <input type="text" id="lastname" name="clientLastname" required><br>
                        <label for="clientEmail">Email <strong>(Required)</strong></label><br>
                        <input type="email" id="email" name="clientEmail" required><br>
                        <label for="clientPassword">Password <strong>(Required)</strong></label><br>
                        <input type="password" id="password" name="clientPassword" required><br><br>
                        <input class="form-submit-button" type="submit" value="Register">
                        <!-- Add the action name - value pair -->
                        <input type="hidden" name="action" value="register">
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