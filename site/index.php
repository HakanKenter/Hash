<?php
session_start();
require_once('./config.php');
$page_name = "Accueil";

// var_dump(hash_algos());
// var_dump(hash('md5', 'password'))
?>
<?php ob_start(); ?>

    <ul class="choice-form mt-5 d-flex mx-auto text-dark border border-rounded bg-secondary justify-content-around">
        <li><a class="text-light" href="./crackMdp.php">Cracker un MDP</a></li>
        <li><a class="text-light" href="./hashMdp.php">Hasher un MDP</a></li>
    </ul>
    <div class="hackPassword">
        <?php if( isset($_SESSION['hackPassword']) && $_SESSION['hackPassword']): ?>
            <p class="hackPasswordText">
                <?= $_SESSION['hackPassword']; ?>
            </p>
        <?php elseif( isset($_SESSION['hackPasswordError']) && $_SESSION['hackPasswordError'] ): ?>
            <p class="hashPasswordText">
                <?= $_SESSION['hackPasswordError']; ?>
            </p>
        <?php endif; ?>
    </div>

    <div class="hashPassword">
        <?php if( isset($_SESSION['hashPassword']) && $_SESSION['hashPassword']): ?>
            <p class="hashPasswordText">
                <?= "Le hash de votre MDP est : " . $_SESSION['hashPassword']; ?>
            </p>
        <?php endif; ?>
    </div>

    <?php if( isset($_SESSION['is_logged']) && $_SESSION['is_logged']): ?>
    <p>Bonjour <?= $_SESSION['username']; ?></p>
    <?php else: ?>
    <p>Accueil</p>
    <?php endif; ?>
<?php
unset($_SESSION['hackPasswordError']);
unset($_SESSION['hackPassword']);
unset($_SESSION['hashPassword']);
$content = ob_get_clean();
include("layouts/home_layout.php"); 