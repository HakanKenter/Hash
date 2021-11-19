<?php 

session_start();

require('../config.php');
require('../errors.php');
require('../functions.php');

// var_dump($_POST);die();

// Vérifier que les champs obligatoire existent
if( !array_contains($_POST, ['algo2', 'mdp'])) { 
    echo "Il manque des informations";
    die;
}

// Filtrer les entrées utilisateurs
$algo = $_POST['algo2'];
$mdp = trim(strtolower(htmlentities($_POST['mdp'], ENT_QUOTES)));

// var_dump($_POST); die();
// Vérifier leurs conformité
if(!strlen_between($_POST['mdp'], 1, 256)) {
    echo "hash trop long";
    die();
}

function mdpHash($algo, $mdp) {
    $_SESSION['hashPassword'] = hash($algo, $mdp);
    return $_SESSION['hashPassword'];
}
mdpHash($algo, $mdp);

// Récuperer les infos du dictionnaire
$content = file_get_contents("../backend/dictionnaire2.txt", true);
if($content === false) {
    die('erreur de lecture du fichier dictionnaire');
}
$dict = explode("\n", $content);

// Revoir la fonction d'ajout de mdp en BDD
foreach($dict as $password) {
    $orig_password = trim($mdp);
    $find = false;
    // Add password in dctionnaire.txt
    if($orig_password !== trim($password)) {
        $find = true;
        array_push($dict, $mdp);
        break;
    } 
}

header('Location: /hash/site/index.php');
?>