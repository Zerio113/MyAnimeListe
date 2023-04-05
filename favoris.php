<?php
session_start();
if(isset($_SESSION['email']) && !empty($_SESSION['email'])) {
  // la session est valide, stocker l'email dans une variable JavaScript
  echo "<script>var userEmail = " . json_encode($_SESSION['email']) . ";</script>";
} else {
  // la session n'est pas valide, rediriger l'utilisateur vers la page de connexion
  header('Location: login.php');
  exit;
}
?>

<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My anime list</title>
    <link rel="icon" href="https://i.pinimg.com/474x/3e/55/1c/3e551cb588a9263b9f438ce573aa8e04.jpg">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- Css -->
    <link rel="stylesheet" href="assets/css/styles.css">
    
  </head>
  <body>



<!-- ---------------------------------------- navbar ---------------------------------------- -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand text-success" href="indexuser.php">My anime list</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="form-inline my-2 my-lg-0" id="search-form">
            <a href="favorisuser.html" class="btn btn-outline-success my-2 my-sm-0">Rechercher les favoris d'un utilisateur ici !</a>
</form>

                <ul class="navbar-nav ml-auto"> <!-- ml-auto -->
                    <li class="nav-item active">
                        <a class="nav-link" href="deconnexion.php">Déconnexion <span class="sr-only">(current)</span></a>
                    </li>
                    
                    
                    </ul>
            </div>
        </div>
    </nav>
<!-- ---------------------------------------- navbar ---------------------------------------- -->



<!-- ---------------------------------------- carousel ---------------------------------------- -->
    <div class="row mb-4">
        <div class="col">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>      
                </ol>
                <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://static.myfigurecollection.net/upload/pictures/2018/01/09/1898432.jpeg" class="d-block w-100 img-carrusel" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://wallpapercave.com/wp/wp2513220.jpg" class="d-block w-100 img-carrusel" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                </div>
                <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Précédant</span>
                </button>
                <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Suivant</span>
                </button>
            </div>
        </div>
    </div>
<!-- ---------------------------------------- carousel ---------------------------------------- -->



<!-- ---------------------------------------- Left row ---------------------------------------- -->
    <div class="row">
        <div class="col-md-3">
            <aside >
                <ul class="list-group" id="user">
                    <li class="list-group-item list-group-item-success text-center">Mon compte</li>
                        <superbutton><img src="https://picsum.photos/800"></superbutton>
                </ul>
            </aside>
        </div>
<!-- ---------------------------------------- Left row ---------------------------------------- -->
<!-- ---------------------------------------- +++++++++ ---------------------------------------- -->        
<!-- ---------------------------------------- Right row ---------------------------------------- -->         
<div class="col-md-9">
    <h2 class="mt-4">Favoris :</h2>    
    <div class="container mt-5" id="favoris" style="border-top-left-radius: 1rem">
      <h1 class="text-center"></h1>
      <div class="row row-cols-1 row-cols-md-4 mt-4" >
      </div>
    </div>
  
    <h2 class="mt-4">Watchlist :</h2>
    <div class="container mt-5" id="info">
      <h1 class="text-center"></h1>
      <div class="row row-cols-1 row-cols-md-4 mt-4" id="watchlist">
      </div>
    </div>
  
    <!-- Ajouter le script ici -->


    
    <script>
fetch(`http://localhost:4000/favorites/${userEmail}`)
  .then(response => response.json())
  .then(data => {
    console.log('Favoris récupérés depuis la base de données :', data);

    // Sélectionner l'élément HTML où afficher les favoris
    const favoritesContainer = document.querySelector('#favoris');

    // Vider le contenu actuel de l'élément
    favoritesContainer.innerHTML = '';

    // Parcourir chaque favori et générer du HTML pour l'afficher
    data.forEach(favorite => {
      // Créer un élément HTML de type <div> pour chaque favori
      const favoriteDiv = document.createElement('div');

      // Ajouter une classe CSS pour le style
      favoriteDiv.classList.add('col');

      // Générer le contenu HTML à afficher dans le <div>
      const favoriteContent = `
        <a href="infoanime.php?id=${favorite.anime_id}" class="list-group-item list-group-item-action d-flex">
          <div class="d-flex align-items-center">
            <img src="${favorite.image}" alt="Image" height="80" width="50">
          </div>
          <div class="pl-3">
            <p class="text-success mb-2">${favorite.title}</p>
          </div>
        </a>
        <button class="del btn btn-danger" id="${favorite.anime_id}" style="margin: auto;text-align: center;margin-top: 10px;" onClick="supprimerFavori('${favorite.anime_id}', '${favorite.email}')">Supprimer</button>
      `;

        // Ajouter le contenu HTML au <div>
        favoriteDiv.innerHTML = favoriteContent;

        // Ajouter le <div> à l'élément HTML où afficher les favoris
        favoritesContainer.appendChild(favoriteDiv);
      });
    })
    .catch(error => console.error('Erreur lors de la récupération des favoris :', error));
</script>

  
<!-- ---------------------------------------- Right row ---------------------------------------- -->
<script>


// Fonction pour supprimer un favori
function supprimerFavori(animeId, userEmail) {
    fetch(`http://localhost:4000/favorites/${animeId}/${userEmail}`, { method: 'DELETE' })
      .then((response) => response.text())
      .then((data) => {
        console.log(data);
        // Recharger la page après la suppression
        window.location.reload();
      })
      .catch((error) => console.error(error));
  }
  
  // Boucle pour ajouter un écouteur d'événements à chaque bouton de suppression
  const deleteButtons = document.querySelectorAll('.del');
  deleteButtons.forEach((button) => {
    button.addEventListener('click', () => {
      const animeId = button.id;
      supprimerFavori(animeId);
    });
  });
</script>
<script>
  function rechercherUtilisateur() {
  const recherche = document.getElementById('search-input').value;
  if (recherche) {
    window.location.href = `favorisuser.html?utilisateur=${recherche}`;
  }
}
  </script>

<!-- ----------------------------------------  Footer  ---------------------------------------- -->
    <footer class="mt-3 p-4 bg-dark text-center text-white">
        BTS SIO Esiee-IT Project : My anime list &copy; 2022
    </footer>
<!-- ----------------------------------------  Footer  ---------------------------------------- -->
   


<!-- ----------------------------------------  Script  ---------------------------------------- -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    

<!-- ----------------------------------------  Script  ---------------------------------------- -->


  </body>
</html>