const express = require('express');
const cors = require('cors');
const mysql = require('mysql');
const app = express();

app.use(cors());
app.use(express.json());

// Création de la connexion à la base de données
const connection = mysql.createConnection({
  host: 'mysql-myanimelist.alwaysdata.net',
  user: '306030',
  password: 'Lakdou123',
  database: 'myanimelist_all'
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

  const query = `INSERT INTO favorites (title, image, anime_id, email) VALUES (?, ?, ?, ?)`;
  const values = [title, image, id, email];

  connection.query(query, values, (err, result) => {
    if (err) {
      console.error('Erreur lors de l\'insertion du favori :', err);
      res.status(500).send('Erreur lors de l\'insertion du favori.');
    } else {
      console.log('Favori ajouté à la base de données !');
      res.status(200).send('Favori ajouté à la base de données.');
    }
  });
});

// Route pour supprimer un favori de la base de données
app.delete('/favorites/:id', (req, res) => {
  const id = req.params.id;

  const query = `DELETE FROM favorites WHERE anime_id = ${id}`;
 
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


// Lancement du serveur
const port = 4000;
app.listen(port, () => {
  console.log(`Serveur lancé sur le port ${port}`);
});
