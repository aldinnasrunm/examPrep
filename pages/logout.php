<?php
require_once('../conn.php');
session_start(); // Start the session to access session variables

function logout() {
    // Unset all of the session variables
    $_SESSION = array();
    // Destroy the session
    session_destroy();
    // Redirect the user to the login page (or any other desired page)
    header("Location: login.php");
    exit();
}

// Check if the logout button has been clicked
if (isset($_POST['logout'])) {
    logout();
}
?>