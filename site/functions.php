<?php 

function error($msg, $url) {
    $_SESSION['error'] = $msg;
    header("Location: $url");
    die();
}

// Déclarer une fonction "array empty"
// qui prend un tableau, et un tableau de clé
// qui retourne true si l'une des clés est vide
// false sinon 

function array_contains($array, $keys) {
    foreach($keys as $key) {
      if(empty($array[$key])) 
        return false;
    }
    return true;
  }

// Déclarer une fonction "strlen_between"
// qui prend une chaine, un minimum et un maximum
// qui renvoi true si la longueur de la chaine est 
// comprise entre le min et le max
// false sinon

function strlen_between($str, $min, $max) {
    return ($len = strlen($str)) >= $min && $len <= $max;
}



?>