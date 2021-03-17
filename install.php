<?php
/* install.php
 * A quick way of setting up the database tables needed to run the CMS.
 * joni1307@student.miun.se | HT20 | DT173G, Projekt
 */

require_once("./includes/classes/Database.class.php");

// Establish a connection
$database = new Database();
$db = $database->connect();

// Set up the first query
$query = "
CREATE TABLE IF NOT EXISTS `Education` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `title` varchar(256) NOT NULL,
   `school` varchar(256) NOT NULL,
   `description` text NOT NULL,
   `date_start` date NOT NULL,
   `date_end` date NOT NULL,
   `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8";

// Prepare the query and execute it
$stmt = $db->prepare($query);
if($stmt->execute()) {
   echo "<p>Added the <i>Education</i> table</p>";
   echo "<pre>" . $query . "</pre>";
} else {
   echo "<p>Failed to add the <i>Education</i> table</p>";
}

// Set up the second query
$query = "
CREATE TABLE IF NOT EXISTS `Employment` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `title` varchar(256) NOT NULL,
   `company` varchar(256) NOT NULL,
   `description` text NOT NULL,
   `date_start` date NOT NULL,
   `date_end` date NOT NULL,
   `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8";

// Prepare the query and execute it
$stmt = $db->prepare($query);
if($stmt->execute()) {
   echo "<p>Added the <i>Employment</i> table</p>";
   echo "<pre>" . $query . "</pre>";
} else {
   echo "<p>Failed to add the <i>Employment</i> table</p>";
}

// Set up the third query
$query = "
CREATE TABLE IF NOT EXISTS `Project` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `title` varchar(256) NOT NULL,
   `url` varchar(256) NOT NULL,
   `description` text NOT NULL,
   `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8";

// Prepare the query and execute it
$stmt = $db->prepare($query);
if($stmt->execute()) {
   echo "<p>Added the <i>Project</i> table</p>";
   echo "<pre>" . $query . "</pre>";
} else {
   echo "<p>Failed to add the <i>Project</i> table</p>";
}

// Set up the fourth query
$query = "
CREATE TABLE IF NOT EXISTS `Users` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `email` varchar(128) NOT NULL UNIQUE,
   `name_first` varchar(32) NOT NULL,
   `name_last` varchar(32) NOT NULL,
   `password` char(128) NOT NULL,
   `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8";

// Prepare the query and execute it
$stmt = $db->prepare($query);
if($stmt->execute()) {
   echo "<p>Added the <i>Users</i> table</p>";
   echo "<pre>" . $query . "</pre>";
} else {
   echo "<p>Failed to add the <i>Users</i> table</p>";
}

// Close the connection
$db = $database->close();