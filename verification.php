<?php
session_start(); // démarrer la session

if(isset($_POST['email']) && isset($_POST['mdp']))
{
 // connexion à la base de données
 $db_username = '306030';
 $db_password = 'Lakdou123';
 $db_name = 'myanimelist_all';
 $db_host = 'mysql-myanimelist.alwaysdata.net';
 $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
 or die('could not connect to database');
 
 // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
 // pour éliminer toute attaque de type injection SQL et XSS
 $email = mysqli_real_escape_string($db,htmlspecialchars($_POST['email'])); 
 $mdp = mysqli_real_escape_string($db,htmlspecialchars($_POST['mdp']));
 
 if($email !== "" && $mdp !== "")
 {
 $requete = "SELECT count(*) FROM utilisateurs where 
 email = '".$email."' and mdp = '".$mdp."' ";
 $exec_requete = mysqli_query($db,$requete);
 $reponse = mysqli_fetch_array($exec_requete);
 $count = $reponse['count(*)'];
 if($count!=0) // nom d'utilisateur et mot de passe correctes
 {
 $token = bin2hex(random_bytes(64));
    $_SESSION['token'] = $token;
    $_SESSION['email'] = $email;
 header('Location: indexuser.php');
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
 header('Location: login.php?erreur=2'); // utilisateur ou mot de passe vide
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
