<?php
session_start(); // démarrer la session

if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['mdp']))
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
 $name = mysqli_real_escape_string($db,htmlspecialchars($_POST['name'])); 
 $surname = mysqli_real_escape_string($db,htmlspecialchars($_POST['surname']));
 $email = mysqli_real_escape_string($db,htmlspecialchars($_POST['email'])); 
 $mdp = mysqli_real_escape_string($db,htmlspecialchars($_POST['mdp'])); 


 // requête préparée
 $requete = "INSERT INTO utilisateurs (name, surname, email, mdp) VALUES (?,?,?,?)";
 $stmt = mysqli_prepare($db, $requete);
 mysqli_stmt_bind_param($stmt, 'ssss', $name, $surname, $email, $mdp);
 mysqli_stmt_execute($stmt);
 mysqli_stmt_close($stmt);
 

}

mysqli_close($db); // fermer la connexion
?>
