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

<header class="site-header">
   <p class="logo"><?= SITENAME ?></p>

   <nav class="nav-primary">
      <ul>
         <li><a href="admin.php">Adminpanel</a></li>
         <li><a href="editor.php">Skapa</a></li>
         <li><a href="logout.php">Logga ut</a></li>
      </ul>
   </nav>
</header>

<main class="page-content">