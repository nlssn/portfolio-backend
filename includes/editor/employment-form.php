<?php
/* includes/editor/employment-form.php
 * Create/Edit forms for employment items.
 * joni1307@student.miun.se | HT20 | DT173G, Projekt
 */

// Connect to DB and get the required content
if ($isEditing) {
   $database = new Database();
   $db = $database->connect();
   $result = new Employment($db);
   $item = $result->getSingleEmployment($id);
}
?>

<div class="form-container">
   <form method="POST">
      <label for="title">Titel för anställning</label>
      <input type="text"name="title" id="title" <?php if($isEditing) { echo 'value="' . $item["title"] . '"'; } ?>>
      <label for="company">Företag</label>
      <input type="text" name="company" id="company" <?php if($isEditing) { echo 'value="' . $item["company"] . '"'; } ?>>
      <label for="description">Beskrivning</label>
      <textarea name="description" id="description" cols="30" rows="8"><?php if($isEditing) { echo $item["description"]; } ?></textarea>
      <label for="date_start">Startdatum</label>
      <input type="date" name="date_start" id="date_start" <?php if($isEditing) { echo 'value="' . $item["date_start"] . '"'; } ?>>
      <label for="date_end">Slutdatum</label>
      <input type="date" name="date_end" id="date_end" <?php if($isEditing) { echo 'value="' . $item["date_end"] . '"'; } ?>>
      <input type="submit" value="<?php if($isEditing) { echo "Spara anställning" ; } else { echo "Skapa anställning"; } ?>">
   </form>
</div>
