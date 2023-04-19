
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
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Delicious+Handrawn&display=swap" rel="stylesheet">
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
<nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <div class="container">
        <a class="navbar-brand text-white" href="index.php" style="font-family: 'Anton', sans-serif;font-size: 25px; letter-spacing: 1px; text-shadow: 1px 1px 2px #000000; color: #FFC300;">MyAnimeList</a>
        <form class="form-inline my-2 my-lg-0" id="search-form">
                    <input class="form-control mr-sm-2" type="search" placeholder="Identifiant?" aria-label="" id="search-input">
                    <button class="btn btn-primary my-2 my-sm-0" type="submit">Rechercher</button>
                  </form>   
                
</form>

                <ul class="navbar-nav ml-auto"> <!-- ml-auto -->
                    <li class="nav-item active">
                        <a class="nav-link" href="deconnexion.php">Déconnexion <span class="sr-only">(current)</span></a>
                    </li>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                   
                    
                    
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
                <li class="list-group-item" style="background-color: #ADD8E6;">Mon compte</li>
                        <superbutton><img src="https://picsum.photos/800"></superbutton>
                </ul>
            </aside>
        </div>
<!-- ---------------------------------------- Left row ---------------------------------------- -->
<!-- ---------------------------------------- +++++++++ ---------------------------------------- -->        
<!-- ---------------------------------------- Right row ---------------------------------------- -->         
<div class="col-md-9">
<h2 class="mt-4" style ="font-family: 'Delicious Handrawn', cursive;">Favoris :</h2>
    <div class="container mt-5" id="favoris" style="border-top-left-radius: 1rem">
      <h1 class="text-center"></h1>
      <div class="row row-cols-1 row-cols-md-4 mt-4" >
      </div>
    </div>
  
    
  
    <!-- Ajouter le script ici -->



<script>
        const searchForm = document.querySelector('#search-form');

searchForm.addEventListener('submit', (event) => {
  event.preventDefault(); // Empêcher l'envoi du formulaire

  const searchInput = document.querySelector('#search-input');
  const userEmail = searchInput.value;

  fetch(`http://localhost:4000/favorites/${userEmail}`)
  .then(response => response.json())
  .then(data => {
    console.log('Favoris récupérés depuis la base de données :', data);

    // Sélectionner l'élément HTML où afficher les favoris
    const favoritesContainer = document.querySelector('#favoris');

    // Vider le contenu actuel de l'élément
    favoritesContainer.innerHTML = '';

    // Créer une rangée pour afficher les cartes en colonne
    const favoritesRow = document.createElement('div');
    favoritesRow.classList.add('row');

    // Parcourir chaque favori et générer du HTML pour l'afficher
    data.forEach(favorite => {
      // Créer un élément HTML de type <div> pour chaque favori
      const favoriteDiv = document.createElement('div');

      // Ajouter une classe CSS pour le style
      favoriteDiv.classList.add('col-12', 'col-md-6', 'col-lg-4');

      // Générer le contenu HTML à afficher dans le <div>
      const favoriteContent = `
        <div class="card mb-4 box-shadow">
          <img class="card-img-top" src="${favorite.image}" alt="Image">
          <div class="card-body p-2">
            <h6 class="card-title mb-1">${favorite.title}</h6>
          </div>
        </div>
      `;

      // Ajouter le contenu HTML au <div>
      favoriteDiv.innerHTML = favoriteContent;

      // Ajouter le <div> à la rangée
      favoritesRow.appendChild(favoriteDiv);
    });

    // Ajouter la rangée à l'élément HTML où afficher les favoris
    favoritesContainer.appendChild(favoritesRow);
  })
  .catch(error => console.error('Erreur lors de la récupération des favoris :', error));
});

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