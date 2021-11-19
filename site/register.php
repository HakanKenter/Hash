<?php
    session_start();
    $page_name = "Inscription";
?>
<?php ob_start(); ?>
    <form class="RegisterForm" action="backend/register_back.php" method="POST">
        <input class="text" type="username" name="username" placeholder="Nom d'utilisateur" required>
        <input class="password" type="password" name="password" placeholder="Mot de passe" required>
        <input class="password" type="password" name="confirm" placeholder="Confirmez le mot de passe" required>
        <button type="submit">Envoyer</button>
    </form>
<?php
$content = ob_get_clean();
include("layouts/base_layout.php"); 