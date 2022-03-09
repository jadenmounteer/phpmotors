<?php
    // Check if the user is logged in and is an admin...
    checkIfAdminAndLoggedIn();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css" media="screen">

    <!-- Display the user's name in the title -->
    <title><?php if(isset($clientFirstname) && isset($clientLastname)){ 
	 echo "Update $clientFirstname $clientLastname's account";}?> | PHP Motors</title>

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
                <h1 class="content-title">Manage Account</h1>

                <div class="form-div">
                    <?php
                        // Show any messages that need to be displayed
                        if (isset($message)) {
                        echo $message;
                        }
                    ?>
    
                    <!-- The Account Update form -->
                    <h2>Update Account</h2>
                    <form action="/phpmotors/accounts/index.php" method="post">
                        <label for="clientFirstname">First Name <strong>(Required)</strong></label><br>
                        <input type="text" id="clientFirstname" name="clientFirstname" required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?>><br>
                        <label for="clientLastname">Last Name <strong>(Required)</strong></label><br>
                        <input type="text" id="clientLastname" name="clientLastname" required <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?>><br>
                        <label for="clientEmail">Email <strong>(Required)</strong></label><br>
                        <input type="email" id="clientEmail" name="clientEmail" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>><br>
                        <input class="form-submit-button" type="submit" value="Update Info">
                        <!-- Add the action name - value pair -->
                        <input type="hidden" name="action" value="updateInfo">
                        <!-- A second hidden input to store the primary key value for the client Id -->
                        <input type="hidden" name="clientId" value="<?php if(isset($clientId)){ echo $clientId;} ?>">
                    </form> 
                    </div>
                    <div class="form-div">
                    <!-- The Change Password form -->
                    <h2>Update Password</h2>
                    <form action="/phpmotors/accounts/index.php" method="post">
                        <span class="info-text">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.</span><br><br>
                        <span class="info-text">*note your original password will be changed.</span><br><br>
                        <label for="clientPassword">Password <strong>(Required)</strong></label><br>
                        <input type="password" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                        <input class="form-submit-button" type="submit" value="Update Password">
                        <!-- Add the action name - value pair -->
                        <input type="hidden" name="action" value="updatePassword">
                        <!-- A second hidden input to store the primary key value for the client Id -->
                        <input type="hidden" name="clientId" value="<?php if(isset($clientId)){ echo $clientId;} ?>">   
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