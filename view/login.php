<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css" media="screen">
    <title>PHP Motors | Login</title>
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
                <h1 class="content-title">Sign in</h1>
                <!-- Prompt the user for their email and password -->
                <div class="form-div">
                    <?php
                        // Show any messages that need to be displayed
                        if (isset($message)) {
                        echo $message;
                        }
                    ?>
                    <form action="/phpmotors/accounts/index.php" method="post">
                        <label for="clientEmail">Email <strong>(Required)</strong></label><br>
                        <input type="email" id="clientEmail" name="clientEmail" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>><br>
                        <label for="clientPassword">Password <strong>(Required)</strong></label ><br>
                        <input type="password" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                        <span class="info-text">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.</span><br><br>
                        <input class="form-submit-button" type="submit" value="Sign In">
                        <!-- Add the action name - value pair -->
                        <input type="hidden" name="action" value="login">
                    </form> <br>
                    <a title="register link" class="user-login-button light-font" href="/phpmotors/accounts/index.php?action=register">Not a member yet?</a>
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