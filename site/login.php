<?php
    require_once('./config.php');
    session_start();
    $page_name = "Se Connecter";
?>
<?php ob_start(); ?>
    <?php if(!empty($_SESSION['error'])): ?>
        <div class="Error">
            <p><?= $_SESSION['error']; ?></p>
        </div>
    <?php endif; ?>
    <form class="historiqueForm" action="backend/login_back.php" method="POST">
        <input class="text" type="username" name="username" placeholder="Nom d'utilisateur" required>
        <input class="password" type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Envoyer</button>
    </form>
    <p class="RegisterMsg">Pas encore inscrit ? </p> <a class="RegisterMsg" href="/hash/site/register.php">Créer un compte</a>
<?php
unset($_SESSION['error']);
$content = ob_get_clean();
include("layouts/base_layout.php"); 