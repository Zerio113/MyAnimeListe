fetch('http://localhost:4000/favorites')
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
      <div class="col mb-4">
      <a href="infoanime.php?id=${favorite.anime_id}">
          <div class="card card-animation">
              <img src="${favorite.image}" class="card-img-top" alt="${favorite.title}">
              <div class="card-body">
                  <h5 class="card-title">${favorite.title}</h5>
              </div>
              
          </div>
      </a>
      <button class="del btn btn-danger" id="${favorite.anime_id}"
          style="margin: auto;text-align: center;margin-top: 10px;"> &gt;Supprimer
      </button>
      </div>
      `;

      // Ajouter le contenu HTML au <div>
      favoriteDiv.innerHTML = favoriteContent;

      // Ajouter le <div> à l'élément HTML où afficher les favoris
      favoritesContainer.appendChild(favoriteDiv);
    });
  })
  .catch(error => console.error('Erreur lors de la récupération des favoris :', error));
