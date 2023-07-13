<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // If logged in, unset all session variables
    $_SESSION = array();
    
    // Destroy the session
    session_destroy();
    
    // Redirect to the login page or any other desired page
    header("Location: login.php");
    exit();
    
} else {
    // If not logged in, redirect to the login page or any other desired page
    header("Location: login.php");
    exit();
}
?>