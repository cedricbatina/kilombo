<?php

$themes = array(
 array(
  "theme" => "clair",
  "couleurs" => array(
   "texte" => "#333333",
   "fond" => "#ffffff",
   "lien" => "#007bff",
   "bouton" => "#007bff",
   "bouton_texte" => "#ffffff"
  )
 ),
 array(
  "theme" => "sombre",
  "couleurs" => array(
   "texte" => "#ffffff",
   "fond" => "#333333",
   "lien" => "#4caf50",
   "bouton" => "#4caf50",
   "bouton_texte" => "#ffffff"
  )
 )
);

// Convertir le tableau en JSON
$themes_json = json_encode($themes, JSON_PRETTY_PRINT);

// Enregistrer le JSON dans un fichier
file_put_contents("themes.json", $themes_json);

echo "Fichier 'themes.json' créé avec succès !";
