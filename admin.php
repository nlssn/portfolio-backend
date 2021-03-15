<?php
/* admin.php
 * The dashboard of the CMS. Where the user can access their content.
 * joni1307@student.miun.se | HT20 | DT173G, Projekt
 */
require_once("includes/settings.php");

// Check if the user is logged in
if(!isset($_SESSION["id"])) {
   header("Location: index.php?msg=Du måste logga in&type=error");
}

$page_title = "Adminpanel";
require_once("includes/layout/header.php");
?>

<h1>Hej <?= $_SESSION["name"] ?>! Du är nu inloggad.</h1>
<p>Nedan kan du se lite information om det material du skapat.</p>

<?php
require_once("includes/layout/footer.php");