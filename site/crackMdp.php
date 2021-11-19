<?php
    require_once('./config.php');
    session_start();
    $page_name = "Crack MDP";
?>
<?php ob_start(); ?>
<div class="mdp-crack d-flex flex-column align-items-center">
        <label class="mt-5 mx-auto" for="pet-select">Cracker un mot de passe :</label>
        <form action="<?= $basedir.'/backend/crackMdp_back.php'?>" method="POST">
            <select id="pet-select" name="algo1">
                <option value="">--Veuillez choisir un algorithme--</option>
                <option value="md5">md5</option>
                <option value="sha384">sha384</option>
                <option value="sha256">sha256</option>
                <option value="crc32">crc32</option>
            </select>
            <input class="col-lg-12" type="text" name="hashmdp" placeholder="Veuillez entrer votre mot de passe.">
            <button type="submit">Cracker</button>
        </form>
    </div>
<?php
unset($_SESSION['error']);
$content = ob_get_clean();
include("layouts/base_layout.php"); 