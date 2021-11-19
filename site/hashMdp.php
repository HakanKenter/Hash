<?php
    session_start();
    require_once('./config.php');
    $page_name = "Crack MDP";
?>
<?php ob_start(); ?>
    <div class="hash-mdp d-flex flex-column align-items-center">
        <label class="mt-5 mx-auto" for="pet-select">Hasher un mot de passe :</label>
        <form action="<?= $basedir.'/backend/hashMdp_back.php'?>" method="POST">
            <select id="pet-select" name="algo2">
                <option value="">--Please choose an algorithme--</option>
                <option value="md5">md5</option>
                <option value="sha256">sha256</option>
                <option value="haval160,4">haval160,4</option>
            </select>
            <input class="col-lg-12" type="text" name="mdp" placeholder="Veuillez entrer le mot de passe à hasher.">
            <button type="submit">Hasher</button>
        </form>
    </div>
    </div>
<?php
unset($_SESSION['error']);
$content = ob_get_clean();
include("layouts/base_layout.php"); 