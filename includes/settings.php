<?php
/* includes/layout/footer.php
 * Settings for the CMS.
 * joni1307@student.miun.se | HT20 | DT173G, Projekt
 */

// Start session
session_start();

// Autoload classes
spl_autoload_register(function ($class) {
   include 'classes/' . $class . '.class.php';
});

// Define constants
define('SITENAME', 'nPress');