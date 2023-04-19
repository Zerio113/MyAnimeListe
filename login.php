<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="assets/css/login.css">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Yinka Enoch Adedokun">
  <title>Login Page</title>
  
</head>
<body>
  <div class="login-container">
    <h1>Se connecter</h1>
    <form action="verification.php" method="POST" class="form">
      <input type="email" name="email" placeholder="Adresse e-mail" required>
      <input type="password" name="mdp" placeholder="Mot de passe" required>
      <button type="submit">Se connecter</button>
    </form>
    <?php
      if (isset($_GET['erreur'])) {
        $err = $_GET['erreur'];
        if ($err == 1 || $err == 2) {
          echo "<p class='message' style='color:red'>Utilisateur ou mot de passe incorrect</p>";
        }
}
?>
<p class="message">Pas encore inscrit ? <a href="inscription.php">Créez un compte</a></p>
</div>
</body>
</html>