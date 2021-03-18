<?php
/* includes/editor/employment-form.php
 * Create/Edit forms for employment items.
 * joni1307@student.miun.se | HT20 | DT173G, Projekt
 */

// connect to the database
$database = new Database();
$db = $database->connect();
$employment = new Employment($db);

if ($isEditing) {
   $item = $employment->getSingleEmployment($id);
}

if (isset($_GET["delete"])) {
   if ($_GET["delete"]) {
      $deleted = $employment->deleteEmployment($id);

      if($deleted) {
         header("Location: editor.php?contentType=employment&msg=Utbildning raderad&type=success");
      } else {
         header("Location: editor.php?contentType=employment&id=" . $id ."&msg=Kunde inte radera utbildning. Vänligen försök igen.&type=error");
      }
   }
}

if (isset($_POST["title"])) {
   $employment->title = $_POST["title"];
   $employment->company = $_POST["company"];
   $employment->description = $_POST["description"];
   $employment->date_start = $_POST["date_start"];
   $employment->date_end = $_POST["date_end"];

   if ($isEditing) {
      $updated = $employment->updateEmployment($id);

      if($updated) {
         header("Location: editor.php?contentType=employment&id=" . $updated["id"] . "&msg=Utbildning uppdaterad&type=success");
      } else {
         header("Location: editor.php?contentType=employment&id=" . $id ."&msg=Kunde inte uppdatera utbildning. Vänligen försök igen.&type=error");
      }

   } else {
      $created = $employment->createEmployment();

      if($created) {
         header("Location: editor.php?contentType=employment&id=" . $created["id"] . "&msg=Ny utbildning tillagd&type=success");
      } else {
         header("Location: editor.php?contentType=employment&msg=Kunde inte lägga till utbildning. Vänligen försök igen.&type=error");
      }
   }
}
?>

<div class="form-container">
   <?php if(isset($msg)){ echo '<p class="' . $msg["type"] . '">' . $msg["text"] . '</p>'; } ?> 

   <form method="POST">
      <label for="title">Titel för anställning</label>
      <input type="text"name="title" id="title" <?php if($isEditing) { echo 'value="' . $item["title"] . '"'; } ?> required>
      <label for="company">Företag</label>
      <input type="text" name="company" id="company" <?php if($isEditing) { echo 'value="' . $item["company"] . '"'; } ?> required>
      <label for="description">Beskrivning</label>
      <textarea name="description" id="description" cols="30" rows="8" required><?php if($isEditing) { echo $item["description"]; } ?></textarea>
      <label for="date_start">Startdatum</label>
      <input type="date" name="date_start" id="date_start" <?php if($isEditing) { echo 'value="' . $item["date_start"] . '"'; } ?> required>
      <label for="date_end">Slutdatum</label>
      <input type="date" name="date_end" id="date_end" <?php if($isEditing) { echo 'value="' . $item["date_end"] . '"'; } ?> required>
      <input type="submit" value="<?php if($isEditing) { echo "Spara utbildning" ; } else { echo "Skapa utbildning"; } ?>">
      <?php if($isEditing) { ?><a href="editor?contentType=employment&id=<?= $item["id"] ?>&delete=true">Radera anställning</a><?php } ?>
   </form>
</div>