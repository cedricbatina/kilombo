<?php
require_once 'TeamServices.php';

$teamservice = new TeamService();

// Affichage des équipes
$teams = $teamservice->getteamlist();
echo "<h2>Liste des équipes</h2>";
echo "<ul>";
foreach ($teams as $team) {
 echo "<li>{$team->team_name}</li>";
}
echo "</ul>";

// Affichage des utilisateurs dans une équipe sélectionnée
if (isset($_POST['lst_team'])) {
 $selected_team_id = $_POST['lst_team'];
 $users_in_team = $teamservice->getuserteam($selected_team_id);
 echo "<h2>Utilisateurs dans l'équipe sélectionnée</h2>";
 echo "<ul>";
 foreach ($users_in_team as $user) {
  echo "<li>{$user->name}</li>";
 }
 echo "</ul>";
}

// Affichage des utilisateurs hors de l'équipe sélectionnée
if (isset($_POST['lst_team'])) {
 $selected_team_id = $_POST['lst_team'];
 $users_not_in_team = $teamservice->getusernotinteam($selected_team_id);
 echo "<h2>Utilisateurs hors de l'équipe sélectionnée</h2>";
 echo "<ul>";
 foreach ($users_not_in_team as $user) {
  echo "<li>{$user->name}</li>";
 }
 echo "</ul>";
}

// Ajout d'une nouvelle équipe
if (isset($_POST['cmd_addteam']) && isset($_POST['team_name'])) {
 $new_team_name = $_POST['team_name'];
 $new_team = new TeamEntity();
 $new_team->team_name = $new_team_name;
 $teamservice->addteam($new_team);
 echo "<p>Équipe ajoutée avec succès : $new_team_name</p>";
}
?>

<!-- Formulaire pour sélectionner une équipe -->
<form action="teams.php" method="POST">
 <label for="lst_team">Sélectionner une équipe :</label>
 <select name="lst_team" id="lst_team">
  <?php foreach ($teams as $team) : ?>
   <option value="<?php echo $team->id ?>"><?php echo $team->team_name ?></option>
  <?php endforeach; ?>
 </select>
 <input type="submit" value="Afficher les utilisateurs de l'équipe" name="show_team_users">
</form>

<!-- Formulaire pour ajouter une nouvelle équipe -->
<form action="teams.php" method="POST">
 <label for="team_name">Nom de la nouvelle équipe :</label>
 <input type="text" name="team_name" id="team_name">
 <input type="submit" value="Ajouter une équipe" name="cmd_addteam">
</form>