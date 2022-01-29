<?php
/**
 * Proxy connection to the phpmotors database
 */
function phpmotorsConnect() {
    // Define the necessary variables
    $server = 'mysql';
    $dbname = 'phpmotors';
    $username = 'iClient';
    $password = 'Kp1AsGS)tBoc*dRR';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    // Try to make the connection
    try {
        $link = new PDO($dsn, $username, $password, $options);
        /* if(is_object($link)){
            echo 'It worked!';
        } */
        // Return the connection object
        return $link;

    } catch(PDOException $e) {
        //echo "It didn't work, error: " . $e->getMessage();
        // If it fails to connect, bring the user to the 500 error status page
        header('Location: /phpmotors/view/500.php');
        exit;
    }

}

// Make the connection. Remove this when testing is complete
//phpmotorsConnect();

?>