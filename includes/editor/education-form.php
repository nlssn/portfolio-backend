<?php
/* includes/editor/education-form.php
 * Create/Edit forms for education items.
 * joni1307@student.miun.se | HT20 | DT173G, Projekt
 */

// connect to the database
$database = new Database();
$db = $database->connect();
$education = new Education($db);

if ($isEditing) {
   $item = $education->getSingleEducation($id);
}

if (isset($_GET["delete"])) {
   if ($_GET["delete"]) {
      $deleted = $education->deleteEducation($id);

      if($deleted) {
         header("Location: editor.php?contentType=education&msg=Utbildning raderad&type=success");
      } else {
         header("Location: editor.php?contentType=education&id=" . $id ."&msg=Kunde inte radera utbildning. Vänligen försök igen.&type=error");
      }
   }
}

if (isset($_POST["title"])) {
   $education->title = $_POST["title"];
   $education->school = $_POST["school"];
   $education->description = $_POST["description"];
   $education->date_start = $_POST["date_start"];
   $education->date_end = $_POST["date_end"];

   if ($isEditing) {
      $updated = $education->updateEducation($id);

      if($updated) {
         header("Location: editor.php?contentType=education&id=" . $updated["id"] . "&msg=Utbildning uppdaterad&type=success");
      } else {
         header("Location: editor.php?contentType=education&id=" . $id ."&msg=Kunde inte uppdatera utbildning. Vänligen försök igen.&type=error");
      }

   } else {
      $created = $education->createEducation();

      if($created) {
         header("Location: editor.php?contentType=education&id=" . $created["id"] . "&msg=Ny utbildning tillagd&type=success");
      } else {
         header("Location: editor.php?contentType=education&msg=Kunde inte lägga till utbildning. Vänligen försök igen.&type=error");
      }
   }
}
?>

<div class="form-container">
   <?php if(isset($msg)){ echo '<p class="' . $msg["type"] . '">' . $msg["text"] . '</p>'; } ?>

   <form method="POST">
      <label for="title">Namn på kurs/program</label>
      <input type="text"name="title" id="title" <?php if($isEditing) { echo 'value="' . $item["title"] . '"'; } ?> required>
      <label for="school">Lärosäte</label>
      <input type="text" name="school" id="school" <?php if($isEditing) { echo 'value="' . $item["school"] . '"'; } ?> required>
      <label for="description">Beskrivning</label>
      <textarea name="description" id="description" cols="30" rows="8" required><?php if($isEditing) { echo $item["description"]; } ?></textarea>
      <label for="date_start">Startdatum</label>
      <input type="date" name="date_start" id="date_start" <?php if($isEditing) { echo 'value="' . $item["date_start"] . '"'; } ?> required>
      <label for="date_end">Slutdatum</label>
      <input type="date" name="date_end" id="date_end" <?php if($isEditing) { echo 'value="' . $item["date_end"] . '"'; } ?> required>
      <input type="submit" value="<?php if($isEditing) { echo "Spara utbildning" ; } else { echo "Skapa utbildning"; } ?>">
      <?php if($isEditing) { ?><a href="editor?contentType=education&id=<?= $item["id"] ?>&delete=true">Radera utbildning</a><?php } ?>
   </form>
</div>