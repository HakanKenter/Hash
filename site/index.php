<?php
session_start();
$page_name = "Accueil";
?>
<?php ob_start(); ?>
    <?php if( isset($_SESSION['is_logged']) && $_SESSION['is_logged']): ?>
    <p>Bonjour <?= $_SESSION['username']; ?></p>
    <?php else: ?>
    <p>Accueil</p>
    <?php endif; ?>
<?php
$content = ob_get_clean();
include("layouts/home_layout.php"); 