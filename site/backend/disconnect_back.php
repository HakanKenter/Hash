<?php 
session_start();
session_destroy();

// Redirection
header('Location: /hash/site/login.php');
?>