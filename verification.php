<?php
session_start(); // démarrer la session

if(isset($_POST['email']) && isset($_POST['mdp']))
{
 // connexion à la base de données
 $db_username = 'lakdou';
 $db_password = 'Uv*!rp5p6-i.gHY';
 $db_name = 'lakdou_test';
 $db_host = 'mysql-lakdou.alwaysdata.net';
 $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
 or die('could not connect to database');
 
 // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
 // pour éliminer toute attaque de type injection SQL et XSS
 $email = mysqli_real_escape_string($db,htmlspecialchars($_POST['email'])); 
 $mdp = mysqli_real_escape_string($db,htmlspecialchars($_POST['mdp']));

 // requête préparée
 $requete = "SELECT count(*) FROM utilisateurs WHERE email = ? AND mdp = ?";
 $stmt = mysqli_prepare($db, $requete);
 mysqli_stmt_bind_param($stmt, 'ss', $email, $mdp);
 mysqli_stmt_execute($stmt);
 mysqli_stmt_bind_result($stmt, $count);
 mysqli_stmt_fetch($stmt);
 mysqli_stmt_close($stmt);
 
 if($count!=0) // nom d'utilisateur et mot de passe correctes
 {
 $token = bin2hex(random_bytes(64));
    $_SESSION['token'] = $token;
    $_SESSION['email'] = $email;
 header('Location: index.php');
 exit(); // arrêter l'exécution du script après la redirection
 }
 else
 {
 header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
 exit(); // arrêter l'exécution du script après la redirection
 }
}
else
{
 header('Location: login.php');
 exit(); // arrêter l'exécution du script après la redirection
}

mysqli_close($db); // fermer la connexion
?>
