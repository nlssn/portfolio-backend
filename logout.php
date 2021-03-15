<?php
/* logout.php
 * Logs the user out by destroying the session.
 * joni1307@student.miun.se | HT20 | DT173G, Projekt
 */

// Initialize the session
session_start();

// Unset all the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect the user to the login page
header("Location: index.php?msg=Du är nu utloggad!&type=info");

// Terminate the script
exit;