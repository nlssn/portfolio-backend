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

$page_title = "Skapa";
require_once("includes/layout/header.php");
?>

<h1>Skapa {ny erfarenhet / portfolioinlägg}</h1>
<p>Här laddar vi ett formulär beroende på vad du vill redigera</p>

<?php
require_once("includes/layout/footer.php");