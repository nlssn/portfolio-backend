<?php
/* includes/editor/project-form.php
 * Create/Edit forms for project items.
 * joni1307@student.miun.se | HT20 | DT173G, Projekt
 */

// connect to the database
$database = new Database();
$db = $database->connect();
$project = new Project($db);

if ($isEditing) {
   $item = $project->getSingleProject($id);
}

if (isset($_GET["delete"])) {
   if ($_GET["delete"]) {
      $deleted = $project->deleteProject($id);

      if($deleted) {
         header("Location: editor.php?contentType=project&msg=Projekt raderat&type=success");
      } else {
         header("Location: editor.php?contentType=project&id=" . $id ."&msg=Kunde inte radera projekt. Vänligen försök igen.&type=error");
      }
   }
}

if (isset($_POST["title"])) {
   $project->title = $_POST["title"];
   $project->url = $_POST["url"];
   $project->description = $_POST["description"];

   if ($isEditing) {
      $updated = $project->updateProject($id);

      if($updated) {
         header("Location: editor.php?contentType=project&id=" . $updated["id"] . "&msg=Projekt uppdaterat&type=success");
      } else {
         header("Location: editor.php?contentType=project&id=" . $id ."&msg=Kunde inte uppdatera projekt. Vänligen försök igen.&type=error");
      }

   } else {
      $created = $project->createProject();

      if($created) {
         header("Location: editor.php?contentType=project&id=" . $created["id"] . "&msg=Nytt projekt tillagt&type=success");
      } else {
         header("Location: editor.php?contentType=project&msg=Kunde inte lägga till projekt. Vänligen försök igen.&type=error");
      }
   }
}
?>

<div class="form-container">
   <?php if(isset($msg)){ echo '<p class="' . $msg["type"] . '">' . $msg["text"] . '</p>'; } ?>

   <form method="POST">
      <label for="title">Titel för projekt</label>
      <input type="text"name="title" id="title" <?php if($isEditing) { echo 'value="' . $item["title"] . '"'; } ?>>
      <label for="url">URL</label>
      <input type="url" name="url" id="url" <?php if($isEditing) { echo 'value="' . $item["url"] . '"'; } ?>>
      <label for="description">Beskrivning</label>
      <textarea name="description" id="description" cols="30" rows="8"><?php if($isEditing) { echo $item["description"]; } ?></textarea>
      <input type="submit" value="<?php if($isEditing) { echo "Spara projekt" ; } else { echo "Skapa projekt"; } ?>">
      <?php if($isEditing) { ?><a href="editor?contentType=project&id=<?= $item["id"] ?>&delete=true">Radera projekt</a><?php } ?>
   </form>
</div>
