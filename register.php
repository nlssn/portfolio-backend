<?php
/* register.php
 * Let's a new user register an account.
 * joni1307@student.miun.se | HT20 | DT173G, Projekt
 */

require_once("includes/settings.php");

// Handle registration
if(isset($_POST["name_first"])) {
   $database = new Database();
   $db = $database->connect();

   $user = new User($db);
   $user->name_first = $_POST["name_first"];
   $user->name_last = $_POST["name_last"];
   $user->email = $_POST["email"];
   $user->password = $_POST["password"];

   if($user->createUser()){
      header("Location: index.php?msg=Registreringen lyckades! Du kan nu logga in&type=success");
   } else {
      $msg = array(
         "text" => "Kunde inte skapa användare",
         "type" => "error"
      );
   }
}

$page_title = "Registrering";
require_once("includes/layout/header.php");
?>

<h1>Registrera dig</h1>

<div class="form-container">
   <?php if(isset($msg)){ echo '<p class="' . $msg["type"] . '">' . $msg["text"] . '</p>'; } ?> 

   <form method="POST">
      <label for="name_first">Förnamn</label>
      <input type="text" name="name_first" id="name_first" required>
      <label for="name_last">Efternamn</label>
      <input type="text" name="name_last" id="name_last" required>
      <label for="email">E-post</label>
      <input type="email" name="email" id="email" required>
      <label for="password">Lösenord</label>
      <input type="password" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Måste innehålla minst 8 tecken varav minst en siffra, en stor bokstav och en liten bokstav." required>
      <input type="submit" value="Skapa konto">
   </form>
   <p class="small">Har du redan ett konto? <a href="register.php">Logga in här</a>.</p>
</div>

<?php
require_once("includes/layout/footer.php");