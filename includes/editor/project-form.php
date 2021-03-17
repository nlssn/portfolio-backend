<?php
/* includes/editor/project-form.php
 * Create/Edit form for project items.
 * joni1307@student.miun.se | HT20 | DT173G, Projekt
 */

// Connect to DB and get the required content
if ($isEditing) {
   $database = new Database();
   $db = $database->connect();
   $result = new Project($db);
   $item = $result->getSingleProject($id);
}
?>

<div class="form-container">
   <form method="POST">
      <label for="title">Titel för projekt</label>
      <input type="text"name="title" id="title" <?php if($isEditing) { echo 'value="' . $item["title"] . '"'; } ?>>
      <label for="url">URL</label>
      <input type="url" name="url" id="url" <?php if($isEditing) { echo 'value="' . $item["url"] . '"'; } ?>>
      <label for="description">Beskrivning</label>
      <textarea name="description" id="description" cols="30" rows="8"><?php if($isEditing) { echo $item["description"]; } ?></textarea>
      <input type="submit" value="<?php if($isEditing) { echo "Spara projekt" ; } else { echo "Skapa projekt"; } ?>">
   </form>
</div>
