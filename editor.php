<?php
/* editor.php
 * The content editor for the CMS. 
 * Loads forms depending on which content type the user want's to edit.
 * joni1307@student.miun.se | HT20 | DT173G, Projekt
 */

require_once("includes/settings.php");

// Check if the user is logged in
if(!isset($_SESSION["id"])) {
   header("Location: index.php?msg=Du måste logga in&type=error");
}

// Check if we should be editing or creating something new
if(!isset($_GET["id"])) {
   $editing = false;
   $title_prefix = "Lägg till";
} else {
   $editing = true;
   $title_prefix = "Redigera";
}

// Check what type of content we're editing
if(!isset($_GET["contentType"])) {
   header("Location: admin.php");
} else {
   switch ($_GET["contentType"]) {
      case "experience":
         $contentType = "experience";
         $page_title = $editing ? $title_prefix . " erfarenhet" : $title_prefix . " ny erfarenhet";
         break;
      case "portfolio":
         $contentType = "portfolio";
         $page_title = $editing ? $title_prefix . " portfolioprojekt" : $title_prefix . " nytt portfolioprojekt";;
   }
}

require_once("includes/layout/header.php");
?>

<h1><?= $page_title ?></h1>
<p>Här laddar vi ett formulär beroende på vad du vill redigera</p>

<?php
require_once("includes/layout/footer.php");