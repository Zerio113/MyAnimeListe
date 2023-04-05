
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
    <a href="favoris.php">
  <div class="favori">
    <span>Ajouter aux Favoris &nbsp;&nbsp;</span>
    <i class="fa-solid fa-heart fav"></i>
  </div>
</a>

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
