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
                    <form action="/action_page.php">
                        <label for="email">Email <strong>(Required)</strong></label><br>
                        <input type="email" id="email" name="email" required><br>
                        <label for="password">Password <strong>(Required)</strong></label ><br>
                        <input type="password" id="password" name="password" required><br><br>
                        <input class="form-submit-button" type="submit" value="Sign in">
                    </form> <br>
                    <a title="register link" class="user-login-button light-font" href="/phpmotors/accounts/index.php?action=register">Not a member yet?</a>
                </div>

                <!-- TODO: include something here to enbable to user to go to the registration view -->

            </section>
        </main>

        <!-- Page footer -->
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?> 
        </footer>
    </div>
    
</body>
</html>