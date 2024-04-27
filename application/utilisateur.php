<?php
require_once './services/UserServices.php';

// Initialisation des variables pour éviter les erreurs
$name = $username = $email = $password = $creation_date = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 // Récupérer les données du formulaire
 $name = $_POST['name'];
 $username = $_POST['username'];
 $email = $_POST['email'];
 $password = $_POST['password'];
 $creation_date = $_POST['creation_date'];

 // Créer une instance de l'entité utilisateur
 $user = new UserEntity();
 $user->name = $name;
 $user->username = $username;
 $user->email = $email;
 $user->password = $password;
 $user->creation_date = $creation_date;

 // Appeler la méthode d'ajout d'utilisateur de la couche de service
 $userService = new UserService();
 $userService->addUser($user);

 // Rediriger vers une page de succès ou afficher un message de succès ici
}

// Afficher les données de l'utilisateur enregistré
$userData = "Nom: $name, Pseudo: $username, Email: $email, Mot de passe: $password, Date de création: $creation_date";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Enregistrement Utilisateur</title>
</head>

<body>
 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
  <div>
   <label for="name">Nom:</label>
   <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
  </div>
  <div>
   <label for="username">Pseudo:</label>
   <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
  </div>
  <div>
   <label for="email">Email:</label>
   <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
  </div>
  <div>
   <label for="password">Mot de passe:</label>
   <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>" required>
  </div>
  <div>
   <label for="creation_date">Date de création:</label>
   <input type="date" id="creation_date" name="creation_date" value="<?php echo htmlspecialchars($creation_date); ?>" required>
  </div>
  <button type="submit">Enregistrer</button>
 </form>

 <?php if (!empty($userData)) : ?>
  <p>Données de l'utilisateur enregistré : <?php echo $userData; ?></p>
 <?php endif; ?>
</body>

</html>