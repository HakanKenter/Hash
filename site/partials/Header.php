<?php require_once('config.php'); ?>
<header class="MainHeader">
        <h1 class="MainHeader__Title"><?= $site['title']; ?></h1>

        <nav class="MainNav">
            <ul>
                <li class="MainNav__Item"><a href="/hash/site">Accueil</a></li>
                <?php if( isset($_SESSION['is_logged']) && $_SESSION['is_logged']): ?>
                <li class="MainNav__Item"><a href="/hash/site/historique.php">Historique</a></li>    
                <li class="MainNav__Item"><a href="/hash/site/backend/disconnect_back.php">Se déconnecter</a></li>
                <?php else: ?>
                <li class="MainNav__Item"><a href="/hash/site/login.php">Se connecter</a></li>
                <li class="MainNav__Item"><a href="/hash/site/register.php">S'inscrire</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>