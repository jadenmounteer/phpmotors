<!-- Logo -->
<div class="logo-div">
    <img class="logo-img responsive-image" src="/phpmotors/images/site/logo.png" alt="The PHP Motors logo">
</div>
<!-- User login -->
<div class="user-login-div">
    <!-- Check if the firstname cookie is set. If so, display it. -->
    <?php if(isset($cookieFirstname)){
        echo "<span class='welcome-message'>Welcome, $cookieFirstname </span>";
    } ?>
    <!-- The link points to the "accounts" controller and sends a name-value (a.k.a. key - value) pair 
        as a parameter that tells the controller to deliver the login view. -->
    <a title="View your account" class="user-login-button light-font" href="/phpmotors/accounts/index.php?action=login-page">My Account</a>
</div>