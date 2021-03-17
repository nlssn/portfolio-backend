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
$education = new Education($db);
$employment = new Employment($db);
$project = new Project($db);
$education_items = $education->getEducations()["data"];
$employment_items = $employment->getEmployments()["data"];
$project_items = $project->getProjects()["data"];

$page_title = "Adminpanel";
require_once("includes/layout/header.php");
?>

<h1>Hej <?= $_SESSION["name"] ?>! Du är nu inloggad.</h1>
<p>Nedan kan du se lite information om det material du skapat.</p>

<h2>Anställningar <span="item-count">(<?= count($employment_items) ?>)</span></h2>
<ul>
<?php
   foreach ($employment_items as $item) { ?>
      <li>
         <a href="editor.php?contentType=employment&id=<?= $item["id"] ?>">
            <?= $item["title"] ?> på <?= $item["company"] ?>
         </a>
      </li>
<?php
   } ?>
</ul>

<h2>Utbildningar <span="item-count">(<?= count($education_items) ?>)</span></h2>
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

<h2>Projekt <span="item-count">(<?= count($project_items) ?>)</span></h2>
<ul>
<?php
   foreach ($project_items as $item) { ?>
      <li>
         <a href="editor.php?contentType=project&id=<?= $item["id"] ?>">
            <?= $item["title"] ?>
         </a>
      </li>
<?php
   } ?>
</ul>

<?php
require_once("includes/layout/footer.php");