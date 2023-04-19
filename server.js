const express = require('express');
const cors = require('cors');
const mysql = require('mysql');
const app = express();

app.use(cors());
app.use(express.json());

// Création de la connexion à la base de données
const connection = mysql.createConnection({
  host: 'mysql-lakdou.alwaysdata.net',
  user: 'lakdou',
  password: 'Uv*!rp5p6-i.gHY',
  database: 'lakdou_test'
});

// Vérification de la connexion à la base de données
connection.connect((err) => {
  if (err) {
    console.error('Erreur de connexion à la base de données :', err);
  } else {
    console.log('Connecté à la base de données MySQL !');
  }
});


// Route pour ajouter un favori à la base de données
app.post('/favorites', (req, res) => {
  const { title, image, id, email } = req.body;

  // Vérifier si le favori existe déjà dans la base de données
  const selectQuery = `SELECT * FROM favorites WHERE anime_id = ? AND email = ?`;
  const selectValues = [id, email];

  connection.query(selectQuery, selectValues, (err, result) => {
    if (err) {
      console.error('Erreur lors de la vérification du favori :', err);
      res.status(500).send('Erreur lors de la vérification du favori.');
    } else {
      // Si le favori existe déjà, renvoyer un message à l'utilisateur
      if (result.length > 0) {
        console.log('Le favori est déjà présent dans la base de données !');
        res.status(200).send('Le favori est déjà présent dans la base de données.');
      } else {
        // Sinon, ajouter le favori à la base de données
        const insertQuery = `INSERT INTO favorites (title, image, anime_id, email) VALUES (?, ?, ?, ?)`;
        const insertValues = [title, image, id, email];

        connection.query(insertQuery, insertValues, (err, result) => {
          if (err) {
            console.error('Erreur lors de l\'insertion du favori :', err);
            res.status(500).send('Erreur lors de l\'insertion du favori.');
          } else {
            console.log('Favori ajouté à la base de données !');
            res.status(200).send('Favori ajouté à la base de données.');
          }
        });
      }
    }
  });
});


// Route pour supprimer un favori de la base de données
app.delete('/favorites/:id/:email', (req, res) => {
  const id = req.params.id;
  const email = req.params.email;
  const query = `DELETE FROM favorites WHERE anime_id = ${id} AND email = '${email}'`;
 
  connection.query(query, (err, result) => {
    if (err) {
      console.error('Erreur lors de la suppression du favori :', err);
      res.status(500).send('Erreur lors de la suppression du favori.');
    } else if (result.affectedRows === 0) {
      console.log(`Le favori avec l'identifiant ${id} n'existe pas dans la base de données.`);
      res.status(404).send(`Le favori avec l'identifiant ${id} n'existe pas dans la base de données.`);
    } else {
      console.log(`Favori avec l'identifiant ${id} supprimé de la base de données !`);
      res.status(200).send(`Favori avec l'identifiant ${id} supprimé de la base de données.`);
    }
  });
});

app.get('/favorites/:email', (req, res) => {
  const email = req.params.email;

  const query = `SELECT * FROM favorites WHERE email = ?`;
  const values = [email];

  connection.query(query, values, (err, result) => {
    if (err) {
      console.error('Erreur lors de la récupération des favoris :', err);
      res.status(500).send('Erreur lors de la récupération des favoris.');
    } else {
      console.log('Favoris récupérés depuis la base de données :', result);
      res.status(200).json(result);
    }
  });
});


app.post('/inscription', (req, res) => {
  const { name, surname, email, mdp } = req.body;

  // Vérification des données envoyées dans la requête
  if (!name || !surname || !email || !mdp) {
    return res.status(400).send({ error: 'Tous les champs sont obligatoires' });
  }

  // Sinon, ajouter le favori à la base de données
  const insertQuery = `INSERT INTO utilisateurs (name, surname, email, mdp) VALUES (?, ?, ?, ?)`;
  const insertValues = [name, surname, email, mdp];

  connection.query(insertQuery, insertValues, (err, result) => {
    if (err) {
      console.error('Erreur lors de l\'inscription :', err);
    } else {
      console.log('Utilisateur ajouté à la base de données !');
      // Rediriger vers la page de connexion après l'inscription réussie
      return res.redirect('/animelist/login.php');
    }
  });
});



// Lancement du serveur
const port = 4000;
app.listen(port, () => {
  console.log(`Serveur lancé sur le port ${port}`);
});
