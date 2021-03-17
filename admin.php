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

// Get all the required content
$database = new Database();
$db = $database->connect();
//$employment = new Employment($db);
$education = new Education($db);
//$portfolio = new Portfolio($db);
//$employment_items = $employment->getEmployments()["data"];
//$portfolio_items = $portfolio->getPortfolios()["data"];
$education_items = $education->getEducations()["data"];

$page_title = "Adminpanel";
require_once("includes/layout/header.php");
?>

<h1>Hej <?= $_SESSION["name"] ?>! Du är nu inloggad.</h1>
<p>Nedan kan du se lite information om det material du skapat.</p>

<h2>Utbildningar</h2>
<ul>
<?php
   foreach ($education_items as $item) { ?>
      <li>
         <a href="editor.php?contentType=education&id=<?= $item["id"] ?>">
            <?= $item["title"] ?>
         </a>
      </li>
<?php
   } ?>
</ul>

<?php
require_once("includes/layout/footer.php");