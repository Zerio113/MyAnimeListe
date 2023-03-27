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

<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My anime list</title>
    <link rel="icon" href="https://i.pinimg.com/474x/3e/55/1c/3e551cb588a9263b9f438ce573aa8e04.jpg">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- Css propios -->
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
                <ul class="navbar-nav ml-auto"> <!-- ml-auto -->
                <li class="nav-item active">
                    <a class="nav-link" href="indexuser.php">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item mr-4">
                    <a class="nav-link" href="favoris.php">Favoris</a>
                </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                <ul class="navbar-nav ml-auto">
                  
                  <li class="nav-item mr-4">
                      <a class="nav-link" href="deconnexion.php">Déconnexion</a>
                  </li>
                  
                  </ul>
                </form>
            </div>
        </div>
    </nav>
<!-- ---------------------------------------- navbar ---------------------------------------- -->




    <div class="container mt-5" id="info">     
        <div class="row">
            <div class="col" id="imageBig">
                
            </div>
            <div class="col" id="infoAnime">
                
            </div>
        </div>
    </div>


<!-- ----------------------------------------  Footer  ---------------------------------------- -->
    <footer class="mt-3 p-4 bg-dark text-center text-white">
        BTS SIO Esiee-IT Project : My anime list &copy; 2022
    </footer>
<!-- ----------------------------------------  Footer  ---------------------------------------- -->
   


<!-- ----------------------------------------  Script  ---------------------------------------- -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script>

const image = document.getElementById("imageBig");
const infoAnime = document.getElementById("infoAnime");

let urlA = window.location.href;
let idA = urlA.split("=")[1];

urlID = `https://api.jikan.moe/v4/anime/${idA}`;

async function info(url, image, infoAnime) {
  const response = await fetch(url);
  const data = await response.json();

  const template = `  
    <h1>${data.data.title}</h1>
    <p>${data.data.synopsis}</p>
    <div class="favori">
      <span>Ajouter aux Favoris &nbsp;&nbsp; </span>
      <i class="fa-solid fa-heart fav"></i>
    </div>
  `;

  infoAnime.innerHTML = template;

  const templateImg = `
    <img src="${data.data.images.jpg.large_image_url}" alt="">
  `;

  image.innerHTML = templateImg;

  const fav = document.querySelector(".favori");

  fav.addEventListener("click", () => {
  const title = document.querySelector("h1").innerHTML;
  const image = document.querySelector("img").src;
  const requestOptions = {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ id: idA, title, image, email: userEmail })
  };

  fetch('http://localhost:4000/favorites', requestOptions)
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error(error));
      
  });
}

info(urlID, image, infoAnime);
    </script>
    <script src="assets/js/searcher.js"></script>
    <script type="module" src="app.mjs"></script>

    <script src="https://kit.fontawesome.com/790443b1d9.js" crossorigin="anonymous"></script>
<!-- ----------------------------------------  Script  ---------------------------------------- -->
    

  </body>
</html>