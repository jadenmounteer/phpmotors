<!-- Logo -->
<div class="logo-div">
    <img class="logo-img responsive-image" src="/phpmotors/images/site/logo.png" alt="The PHP Motors logo">
</div>
<!-- User login -->
<div class="user-login-div">
    
    <?php
        // Check if the user is logged in
        if(isset($_SESSION['loggedin'])){
            // Display a welcome message
            // This is a link that, when clicked, directs the user to the accounts controller
            // and delivers the client admin view
            $clientFirstname = $_SESSION['clientData']['clientFirstname'];
            echo "<a class='message-link light-font' href='/phpmotors/accounts/index.php?action=default'>Welcome, $clientFirstname </a>";


            //  Since the user is logged in, we display a link for them to use to logout
            echo "<a title='Logout' class='user-login-button light-font' href='/phpmotors/accounts/index.php?action=logout'>Logout</a>";
        }
        else {
            // Since the user is not logged in, we display the My Account link
            echo "<a title='View your account' class='user-login-button light-font' href='/phpmotors/accounts/index.php?action=login-page'>My Account</a>";
        }
    ?>

    <!-- Check if the firstname cookie is set. If so, display it. THIS HAS BEEN REPLACED WITH THE SESSION MESSAGE -->
    <?php 
        /*
        if(isset($cookieFirstname)){
        echo "<span class='welcome-message'>Welcome, $cookieFirstname </span>";
    }*/ ?>

    <!-- The link points to the "accounts" controller and sends a name-value (a.k.a. key - value) pair 
        as a parameter that tells the controller to deliver the login view. -->
    <!--a title="View your account" class="user-login-button light-font" href="/phpmotors/accounts/index.php?action=login-page">My Account</a>-->
</div>