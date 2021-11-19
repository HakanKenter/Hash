<?php
session_start();


require_once('../config.php');

require_once('../errors.php');
require_once('../functions.php');

// var_dump($_POST); die();

// Vérifier la présence des infos obligatoires
if( !array_contains($_POST, ['username', 'password', 'confirm']) ) {
  error( ERR_MISSING, "$basedir/register.php" );
}
// Les filtrer
$username = trim(strtolower($_POST['username']));
$password = $_POST['password'];
$confirm = $_POST['confirm'];

// Vérifier leur cohérence
if(!strlen_between($username, 1, 16)) {
  error( ERR_USERNAME, "$basedir/register.php" );
}
if(!strlen_between($password, 6, 32)) {
  error( ERR_PASSWORD, "$basedir/register.php" );
}
if($password !== $confirm) {
  error( ERR_CONFIRM, "$basedir/register.php" );
}


// Lire le fichier
$json = file_get_contents("../data/users.json", true);
if( $json === false ) {
  error(ERR_INTERNAL, "$basedir/register.php");
}

// Décoder le json
$users = json_decode($json, true);
// if( $users === null ) {
//   error(ERR_INTERNAL, "$basedir/register.php");
// }
// var_dump(hash('sha256', $pepper.'julien'.'password'));

// Vérifier que login n'existe pas déjà 
foreach($users as $user) {
  if($user['username'] === $username) {
    error( ERR_AEXIST, "$basedir/register.php" );
  }
}

// On l'ajoute à notre tableau d'utilisateur (array_push)
array_push($users, [
    "username" => $username,
    "password" => hash('sha256', $pepper.$username.$password)
  ]);
  
// Encoder le tableau 
$json = json_encode($users);
if($json === false) {
  error(ERR_INTERNAL, "$basedir/register.php");
}

// Écrire le fichier
if(file_put_contents('../data/users.json', $json) === false) {
  error(ERR_INTERNAL, "$basedir/register.php");
}

// Redirection
header("Location: /hash/site/login.php");

?>
