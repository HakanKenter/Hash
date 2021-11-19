<?php

session_start();

require('../config.php');
require('../errors.php');
require('../functions.php');

// var_dump($_POST);die();

// Vérifier que les champs obligatoire existent
if( array_contains($_POST, ['firstname', 'lastname', 'email', 'message'])) { 
    echo "Il manque des informations";
    die;
}

// Filtrer les entrées utilisateurs
$firstname = trim(strtolower(htmlentities($_POST['firstname'], ENT_QUOTES)));
$lastname = trim(strtolower(htmlentities($_POST['lastname'], ENT_QUOTES)));
$email = trim(strtolower(htmlentities($_POST['email'], ENT_QUOTES)));
$message = trim(strtolower(htmlentities($_POST['message'], ENT_QUOTES)));

// Vérifier leurs conformité
if(!strlen_between($_POST['firstname'], 1, 64)) {
    echo "Prénom trop long";
    die();
}
if(!strlen_between($_POST['lastname'], 1, 64)) {
    echo "Nom de famile trop long";
    die();
}
if(!filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL )) {
    echo "Format d'email invalide";
    die();
}
if (!strlen_between($_POST['message'], 1, 65535)) {
    echo "Message trop long";
    die;
}

// Get Fill info
$json = file_get_contents('../data/historiqueMessage.json', true);
// Check if is open
if( $json === false ){
    echo error(ERR_historique, '/hash/site/historique.php');
}

$messageArray = json_decode($json, true);
// Check if is decoded
if( $messageArray === null ) {
    $messageArray = [];
};

// On ajoute un tableau a notre fichier JSON;
array_push($messageArray, [
    "date" => time(),
    "firstname" => $firstname,
    "lastname" => $lastname,
    "email" => $email,
    "message" => $message
]);

$json = json_encode($messageArray);
if( $json === false ) {
    echo error(ERR_historique, '/hash/site/historique.php');
}

file_put_contents('../data/historiqueMessage.json', $json);
if( file_put_contents('../data/historiqueMessage.json', $json) === false) {
    echo error(ERR_INTERNAL, '/hash/site/historique.php');
} 

$_SESSION['successMsg'] = "Votre message a bien été envoyé !";
header('Location: /hash/site/historique.php');


?>