<?php

/* index.php
 * The index of the CMS. Let's the user log in.
 * joni1307@student.miun.se | HT20 | DT173G, Projekt
 */
$page_title = "Logga in";
require_once("includes/layout/header.php");
?>

<h1><?= SITENAME ?></h1>

<div class="form-container">
   <?php if(isset($message)){ echo '<p class="' . $message["type"] . '">' . $message["text"] . '</p>'; } ?> 

   <form action="POST">
      <label for="email">E-post</label>
      <input type="email" name="email" id="email">
      <label for="password">Lösenord</label>
      <input type="password" name="password" id="password">
      <input type="submit" value="Logga in">
   </form>
   <p class="small">Har du inget konto? <a href="register.php">Registrera dig här</a>.</p>
</div>

<?php
require_once("includes/layout/footer.php");