<?php
/* includes/layout/header.php
 * It's the header.
 * joni1307@student.miun.se | HT20 | DT173G, Projekt
 */
?>

<!DOCTYPE html>
<html lang="sv">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= SITENAME . ' &middot; ' . $page_title ?></title>
</head>
<body class="<?= basename($_SERVER['SCRIPT_FILENAME'], '.php') ?>">

<?php 
   if(isset($_SESSION["id"])) { ?>
<header class="site-header">
   <p class="logo"><?= SITENAME ?></p>

   <nav class="nav-primary">
      <ul>
         <li><a href="admin.php">Adminpanel</a></li>
         <li>
            Skapa
            <ul>
               <li><a href="editor.php?contentType=portfolio">Portfolioprojekt</a></li>
               <li><a href="editor.php?contentType=employment">Arbetslivserfarenhet</a></li>
               <li><a href="editor.php?contentType=education">Utbildning</a></li>
            </ul>
         </li>
         <li><a href="logout.php">Logga ut</a></li>
      </ul>
   </nav>
</header>
<?php } ?>

<main class="page-content">