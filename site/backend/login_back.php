<?php
session_start();

require_once('../config.php');

require_once('../errors.php');
require_once('../functions.php');

// Vérifier que les champs obligatoires existent
if( !array_contains($_POST, ['username', 'password']) ) {
  error(ERR_BADID, "$basedir/login.php");
}

// Vérifier leur conformité
if( !strlen_between( $_POST['username'], 1, 16) ||
    !strlen_between( $_POST['password'], 1, 32)) {
  error(ERR_BADID, "$basedir/login.php");
}

// Filtrage les entrées utilisateurs
$username = trim($_POST['username']);
$password = $_POST['password'];

// Traitement

// Étape 1 - Lecture du fichier
$json = file_get_contents("../data/users.json", true);
if($json === false) {
  error(ERR_INTERNAL, "$basedir/login.php");
}

// Étape 2 - Décodage du json 
$users = json_decode($json, true);
if($users === null) {
  error(ERR_INTERNAL, "$basedir/login.php");
}

// Étape 3 - Vérification des entrées utilisateur
$is_logged = false;
foreach($users as $user) {
  // Vérifier l'identifiant et le mdp 
  if( $username === $user['username'] && hash('sha256', $pepper.$username.$password) === $user['password']) {
    $is_logged = true;
    break;
  }
}

if(!$is_logged) {
  error(ERR_BADID, "$basedir/login.php");
}

// Se connecter
$_SESSION['is_logged'] = true;
$_SESSION['username'] = htmlentities($user['username']);

// Redirection
header("Location: $basedir");

?>
