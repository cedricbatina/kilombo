<?php

$date = new DateTime();

// Définir le fuseau horaire
$date->setTimezone(new DateTimeZone('Europe/Paris'));

// Définir le format de date et d'heure
$formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::SHORT)
?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
 <!-- Include the Font Awesome CSS file -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="stylesheet" href="../styles/feuille-de-style.css">
 <title>Document - Entete de page</title>
</head>

<body>
 <div class="entete container-fluid">
  <div class="row">
   <div class="col-9">

    <form action="">
     <div class="form-group container-fluid mt-2">
      <div class="input-group row ">

       <div class="col-8">

        <input type="text" name="search" class="form-control" placeholder="Recherche...">

       </div>

       <div class="col-4">
        <button class="btn btn-primary">Recherche</button>

       </div>
      </div>
     </div>
    </form>

   </div>
   <form action="index.php" method="POST" class="dropdown col-3 form-inline my-1 mt-2-lg-0">
    <div class="form-group">
     <button class=" btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
      Choix du Thème
     </button>
     <select name="lst_theme" id="lst_theme" class="dropdown-menu form-control" onchange="this.form.submit()">
      <option class="lst_theme" value="0">Th&egrave;mes</option>

      <option value="1" <?php echo isset($theme) && $theme == "1" ? "selected" : "" ?>>Clair</option>
      </option>
      <option value="2" <?php echo isset($theme) && $theme == "2" ? "selected" : "" ?>>Sombre</option>

     </select>



    </div>
   </form>
  </div>
  <hr>
  <div class="row nav mb-2">
   <img src="images/official_logo_@bc_transparent.png" alt="logo du site" class="logo col-3 nav-brand ">
   <ul class="nav m-auto col-9">
    <?php require_once "phpinclude/navbar.php"; ?>

   </ul>
  </div>
  <div class="row">
   <p class="text-center"><span class="texte-date">Dernière mise à jour le, </span><span class="creation_date mt-2"><?php echo $formatter->format(new DateTime()); ?></span></p>

  </div>


 </div>

</body>

</html>