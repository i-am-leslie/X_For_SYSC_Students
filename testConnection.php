<?php
    require "connection.php";
        // Create a new connection to the database using mysqli class
    $mysqli = new mysqli($server_name, $username, $password, $database_name);

    // Check if the connection was successful
    if ($mysqli->connect_errno) {
        // Connection error occurred
        die ("Error: Couldn't connect. " . $mysqli->connect_error);
    } else {
        // Connection successful
        echo "Connected Successfully";
        // Close the connection
        $mysqli->close();
    }
    
?>