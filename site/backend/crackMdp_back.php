<?php

session_start();

require('../config.php');
require('../errors.php');
require('../functions.php');

// Vérifier que les champs obligatoire existent
if( !array_contains($_POST, ['algo1', 'hashmdp'])) { 
    echo "Il manque des informations";
    die;
}

// Filtrer les entrées utilisateurs
$algo = $_POST['algo1'];
$hashMdp = trim(strtolower(htmlentities($_POST['hashmdp'], ENT_QUOTES)));

// var_dump($_POST); die();
// Vérifier leurs conformité
if(!strlen_between($_POST['hashmdp'], 1, 256)) {
    echo "hash trop long";
    die();
}

// Récuperer les infos du dictionnaire
$content = "";
if( isset($_SESSION['is_logged']) && $_SESSION['is_logged']) {
    $content = file_get_contents('dictionnaire2.txt', true);
    if($content === false) {
        die('erreur de lecture du fichier dictionnaire');
    }
} else {
    $content = file_get_contents('dictionnaire1.txt', true);
    if($content === false) {
        die('erreur de lecture du fichier dictionnaire');
    }
}

$dict = explode("\n", $content);
array_pop($dict);

$orig_password = trim($hashMdp);
$find = false;

foreach($dict as $password) {
    if($orig_password === hash($algo, trim($password))) {
        $find = true;
        $_SESSION['hackPassword'] = "Le mot de passe recherché est ".": $password\n";
        // echo "MDP STATUS".": $password\n";
        break;
    }
}
if(!$find) {
    $_SESSION['hackPasswordError'] =  "Le mot de passe n'a pas pu être cracker !";
}

header('Location: /hash/site/index.php');

?>