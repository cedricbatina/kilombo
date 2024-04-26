<?php
$date = new DateTime();

// Définir le fuseau horaire
$date->setTimezone(new DateTimeZone('Europe/Paris'));

// Définir le format de date et d'heure
$formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::SHORT)
?>
<!DOCTYPE html>
<html lang="fr">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">


 <link rel="stylesheet" href="./styles/feuille-de-style.css">
 <title>Application - Index</title>
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
   <div class="col-3 container-fluid my-2">
    <form action="index.php" method="POST" class=" form-inline my-1 mt-2-lg-0">
     <div class="form-group">


      <select name="lst_theme" id="lst_theme" class="form-control" onchange="this.form.submit()">
       <option value="0">Th&egrave;me</option>
       <option value="1" <?php echo isset($theme) && $theme == "1" ? "selected" : "" ?>>Clair</option>
       </option>
       <option value="2" <?php echo isset($theme) && $theme == "2" ? "selected" : "" ?>>Sombre</option>
      </select>
     </div>
    </form>
   </div>


  </div>
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