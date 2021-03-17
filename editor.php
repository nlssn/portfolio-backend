<?php
/* editor.php
 * The content editor for the CMS. 
 * Loads forms depending on which content type the user want's to edit or create.
 * joni1307@student.miun.se | HT20 | DT173G, Projekt
 */

require_once("includes/settings.php");

// Check if the user is logged in
if(!isset($_SESSION["id"])) {
   header("Location: index.php?msg=Du måste logga in&type=error");
}

// Check what type of content we're trying to edit/create
if(!isset($_GET["contentType"])) {
   header("Location: admin.php");
} else {
   $contentType = $_GET["contentType"];
}

// Check if we should be editing or creating something new
if(!isset($_GET["id"])) {
   $isEditing = false;
   $title_prefix = "Lägg till";
} else {
   $isEditing = true;
   $id = $_GET["id"];
   $title_prefix = "Redigera";
}

// Set the page_title depending on contentType and isEditing
switch ($contentType) {
   case "employment":
      $page_title = $isEditing ? $title_prefix . " anställning" : $title_prefix . " ny anställning";
      break;
   case "education":
      $page_title = $isEditing ? $title_prefix . " utbildning" : $title_prefix . " ny utbildning";
      break;
   case "project":
      $page_title = $isEditing ? $title_prefix . " projekt" : $title_prefix . " nytt projekt";
      break;
}

require_once("includes/layout/header.php");
?>

<h1><?= $page_title ?></h1>

<?php
// Import the needed form
switch($contentType) {
   case "employment":
      require("includes/editor/employment-form.php");
      break;
   case "education":
      require("includes/editor/education-form.php");
      break;
   case "project":
      require("includes/editor/project-form.php");
      break;
}

require_once("includes/layout/footer.php");