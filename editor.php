<?php

/* editor.php
 * The content editor for the CMS. 
 * Loads forms depending on which content type the user want's to edit.
 * joni1307@student.miun.se | HT20 | DT173G, Projekt
 */
$page_title = "Adminpanel";
require_once("includes/layout/header.php");
?>

<h1>Skapa {ny erfarenhet / portfolioinlägg}</h1>
<p>Här laddar vi ett formulär beroende på vad du vill redigera</p>

<?php
require_once("includes/layout/footer.php");