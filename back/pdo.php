<?php
$hote = 'localhost';
$port = "3306";
$nom_bdd = 'api';
$utilisateur = 'root';
$mot_de_passe ='556800';

try {
    $pdo = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nom_bdd, $utilisateur, $mot_de_passe);

} catch(Exception $e) {
	reponse_json($success, $data, 'Echec de la connexion à la base de données');
    exit();

}