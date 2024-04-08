<?php
    // Start the session
    session_start();

    // Remove all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to login page
    header("Location: login.php");
    exit; // Ensure no further execution in case of redirection failure
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
    <!-- You can place any HTML here if needed, such as a logout message or redirection link -->
</body>
</html>
