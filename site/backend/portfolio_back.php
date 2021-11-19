<?php 

session_start();

require('../errors.php');
require('../functions.php');

var_dump($_POST);
var_dump(file_get_contents('../data/image.json', true));


// Verifier la présence des infos obligatoires
if( array_contains($_POST, ['nom', 'monImage'])) { 
    error(ERR_ADD, '/hash/site/portfolio.php');
}

// Les filtrer
$nom = trim(strtolower($_POST['nom']));
$monImage = trim(strtolower($_POST['monImage']));

// Vérifier leurs cohérence
if( !strlen_between($nom, 1, 16)) {
    error(ERR_USERNAME, '/hash/site/portfolio.php');
}
if( !strlen_between($monImage, 3, 500)) {
    error(ERR_PASSWORD, '/hash/site/portfolio.php');
}

// Lire le fichier
// On récupère les infos du fichier en json
$json = file_get_contents('../data/image.json', true);
// On vérifie qu'il s'est bien ouvert
if( $json === false ) {
    error(ERR_PASSWORD, '/hash/site/portfolio.php');
}

// On décode le JSON récuperé
$img = json_decode($json, true);
if( $img === null ) {
    error(ERR_PASSWORD, '/hash/site/portfolio.php');
}

// On l'ajout à notre tableau d'utilisateur (array_push)
array_push($img, [
    "img" => $monImage
]);

// Encoder le tableau
$json = json_encode($img);
if( $json === false ){
    error(ERR_PASSWORD, '/hash/site/portfolio.php');
}

// Écrire le fichier
if( file_put_contents('../data/image.json', $json) === false) {
    error(ERR_PASSWORD, '/hash/site/portfolio.php');
}

// // REDIRECTION
// header('Location: /hash/site/login.php');
?>